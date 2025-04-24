{* Sign Document Template *}
<script src="https://unpkg.com/pdf-lib@1.17.1"></script>
<style>
{literal}
.pdf-container {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 20px;
    padding: 20px;
    background: #f5f5f5;
    min-height: 100vh;
}

.page-container {
    position: relative;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    background: white;
}

.pdf-canvas {
    display: block;
}

.signature-overlay {
    position: absolute;
    top: 0;
    left: 0;
    cursor: crosshair;
}

.toolbar {
    position: fixed;
    top: 20px;
    right: 20px;
    background: white;
    padding: 10px;
    border-radius: 8px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    display: flex;
    flex-direction: column;
    gap: 10px;
    z-index: 1000;
}

.toolbar button {
    padding: 8px 16px;
    border: none;
    border-radius: 4px;
    background: #007bff;
    color: white;
    cursor: pointer;
    font-size: 14px;
    transition: background 0.2s;
}

.toolbar button:hover {
    background: #0056b3;
}

.toolbar button.active {
    background: #28a745;
}

.toolbar button.clear {
    background: #dc3545;
}

.toolbar button.save {
    background: #28a745;
}

.text-input {
    display: block;
    position: absolute;
    padding: 5px;
    border: 1px solid #ccc;
    background: white;
    z-index: 1000;
    font-size: 16px;
}

.loading {
    position: fixed;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    background: rgba(255,255,255,0.9);
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    z-index: 2000;
}

.error {
    color: #dc3545;
    text-align: center;
    padding: 20px;
}
{/literal}
</style>

<div class="toolbar">
    <button id="signatureBtn">✍️ Draw Signature</button>
    <button id="textBtn">📝 Add Text</button>
    <button id="clearBtn" class="clear">🗑️ Clear All</button>
    <button id="saveBtn" class="save">💾 Save Document</button>
</div>

<div id="loading" class="loading" style="display: none;">
    Saving document...
</div>

<div class="pdf-container" id="pdfContainer"></div>

<form id="signForm" method="post" style="display: none;">
    <input type="hidden" name="signature_data" id="signatureData">
    <input type="hidden" name="csrfp_token" value="{$csrfp_token}">
</form>

<script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.11.174/pdf.min.js"></script>
<script>
{literal}
// Initialize PDF.js
pdfjsLib.GlobalWorkerOptions.workerSrc = 'https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.11.174/pdf.worker.min.js';

// Variables
let currentTool = null;
let isDrawing = false;
let elements = { elements: [] };
let currentPage = 0;
let scale = 1.5;
let activeTextInput = null;

// PDF URL
const pdfUrl = 'view_file.php?submit=view&id={/literal}{$file_id}{literal}&mimetype=application/pdf';

// Load PDF
async function loadPDF() {
    try {
        const loadingTask = pdfjsLib.getDocument(pdfUrl);
        const pdf = await loadingTask.promise;
        
        // Clear container
        const container = document.getElementById('pdfContainer');
        container.innerHTML = '';
        
        // Render each page
        for (let pageNum = 1; pageNum <= pdf.numPages; pageNum++) {
            const page = await pdf.getPage(pageNum);
            const viewport = page.getViewport({ scale });
            
            // Create page container
            const pageContainer = document.createElement('div');
            pageContainer.className = 'page-container';
            pageContainer.dataset.page = pageNum - 1;
            
            // Setup canvas for PDF
            const canvas = document.createElement('canvas');
            canvas.className = 'pdf-canvas';
            const context = canvas.getContext('2d');
            canvas.width = viewport.width;
            canvas.height = viewport.height;
            
            // Setup overlay for drawing
            const overlay = document.createElement('canvas');
            overlay.className = 'signature-overlay';
            overlay.width = viewport.width;
            overlay.height = viewport.height;
            
            pageContainer.style.width = `${viewport.width}px`;
            pageContainer.style.height = `${viewport.height}px`;
            
            pageContainer.appendChild(canvas);
            pageContainer.appendChild(overlay);
            container.appendChild(pageContainer);
            
            // Render PDF page
            await page.render({
                canvasContext: context,
                viewport: viewport
            }).promise;
            
            // Setup event listeners for this page's overlay
            setupOverlayListeners(overlay);
        }
    } catch (error) {
        console.error('Error loading PDF:', error);
        document.getElementById('pdfContainer').innerHTML = '<p class="error">Error loading PDF. Please try again.</p>';
    }
}

// Setup overlay event listeners
function setupOverlayListeners(overlay) {
    let lastX, lastY;
    const ctx = overlay.getContext('2d');
    
    overlay.addEventListener('mousedown', startDrawing);
    overlay.addEventListener('mousemove', draw);
    overlay.addEventListener('mouseup', stopDrawing);
    overlay.addEventListener('mouseout', stopDrawing);
    overlay.addEventListener('click', addText);
    
    function startDrawing(e) {
        if (currentTool !== 'signature') return;
        isDrawing = true;
        [lastX, lastY] = getMousePos(overlay, e);
        ctx.beginPath();
        ctx.moveTo(lastX, lastY);
    }
    
    function draw(e) {
        if (!isDrawing || currentTool !== 'signature') return;
        const [x, y] = getMousePos(overlay, e);
        ctx.lineTo(x, y);
        ctx.strokeStyle = '#000';
        ctx.lineWidth = 2;
        ctx.lineCap = 'round';
        ctx.stroke();
        [lastX, lastY] = [x, y];
    }
    
    function stopDrawing() {
        if (!isDrawing || currentTool !== 'signature') return;
        isDrawing = false;
        // Save signature data
        elements.elements.push({
            type: 'signature',
            page: parseInt(overlay.parentElement.dataset.page),
            data: overlay.toDataURL(),
            x: 0,
            y: 0,
            width: overlay.width,
            height: overlay.height
        });
    }
    
    function addText(e) {
        if (currentTool !== 'text') return;
        
        const [x, y] = getMousePos(overlay, e);
        
        // Remove any existing text input
        if (activeTextInput) {
            activeTextInput.remove();
        }
        
        const input = document.createElement('input');
        input.type = 'text';
        input.className = 'text-input';
        input.style.left = `${e.pageX}px`;
        input.style.top = `${e.pageY}px`;
        
        document.body.appendChild(input);
        activeTextInput = input;
        input.focus();
        
        input.addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                const text = input.value.trim();
                if (text) {
                    const ctx = overlay.getContext('2d');
                    ctx.font = '16px Arial';
                    ctx.fillStyle = '#000';
                    ctx.fillText(text, x, y);
                    
                    elements.elements.push({
                        type: 'text',
                        page: parseInt(overlay.parentElement.dataset.page),
                        text: text,
                        x: x,
                        y: y,
                        fontSize: 16
                    });
                }
                input.remove();
                activeTextInput = null;
            }
        });
        
        input.addEventListener('blur', function() {
            input.remove();
            activeTextInput = null;
        });
    }
}

function getMousePos(canvas, e) {
    const rect = canvas.getBoundingClientRect();
    const scaleX = canvas.width / rect.width;
    const scaleY = canvas.height / rect.height;
    return [
        (e.clientX - rect.left) * scaleX,
        (e.clientY - rect.top) * scaleY
    ];
}

// Tool selection
document.getElementById('signatureBtn').addEventListener('click', function() {
    currentTool = currentTool === 'signature' ? null : 'signature';
    updateToolButtons();
});

document.getElementById('textBtn').addEventListener('click', function() {
    currentTool = currentTool === 'text' ? null : 'text';
    updateToolButtons();
});

document.getElementById('clearBtn').addEventListener('click', function() {
    const overlays = document.querySelectorAll('.signature-overlay');
    overlays.forEach(overlay => {
        const ctx = overlay.getContext('2d');
        ctx.clearRect(0, 0, overlay.width, overlay.height);
    });
    elements.elements = [];
});

document.getElementById('saveBtn').addEventListener('click', async function() {
  if (elements.elements.length === 0) {
    alert('Please add at least one signature or text before saving.');
    return;
  }
  document.getElementById('loading').style.display = 'block';

  try {
    // 1) Create & load
    const pdfDoc       = await PDFLib.PDFDocument.create();
    const existingPdf  = await PDFLib.PDFDocument.load(
      await fetch(pdfUrl).then(r => r.arrayBuffer())
    );
    const copiedPages  = await pdfDoc.copyPages(existingPdf, existingPdf.getPageIndices());
    copiedPages.forEach(p => pdfDoc.addPage(p));

    // 2) Stamp each element back onto its page
    for (const el of elements.elements) {
      const page = pdfDoc.getPage(el.page);

      // — find the right canvas for page el.page
      const pageContainer = document.querySelector(`.page-container[data-page="${el.page}"]`);
      if (!pageContainer) throw new Error(`Page container ${el.page} not found`);
      const canvas = pageContainer.querySelector('canvas.pdf-canvas');
      if (!canvas)   throw new Error(`PDF canvas for page ${el.page} not found`);

      // — compute PDFLib scale from canvas px → PDF points
      const scaleX = page.getWidth()  / canvas.width;
      const scaleY = page.getHeight() / canvas.height;

      // — translate your element coords/sizes into PDF space
      const x = el.x * scaleX;
      const y = el.y * scaleY;
      const w = (el.width  || 0) * scaleX;
      const h = (el.height || 0) * scaleY;

      if (el.type === 'signature') {
        const sigBytes = await fetch(el.data).then(r => r.arrayBuffer());
        const sigImg   = await pdfDoc.embedPng(sigBytes);
        page.drawImage(sigImg, {
          x,
          y: page.getHeight() - y - h,
          width: w,
          height: h
        });

      } else if (el.type === 'text') {
        const fontSizePt = (el.fontSize || 12) * scaleY;
        page.drawText(el.text, {
          x,
          y: page.getHeight() - y - fontSizePt,
          size: fontSizePt,
          color: PDFLib.rgb(0, 0, 0)
        });
      }
    }

    // 3) Serialize & download
    const modifiedBytes = await pdfDoc.save();
    const blob = new Blob([modifiedBytes], { type: 'application/pdf' });
    const ts = new Date().toISOString().replace(/[:.]/g, '-');
    const filename = `signed_document_${ts}.pdf`;
    const url = URL.createObjectURL(blob);
    const a = document.createElement('a');
    a.href = url; a.download = filename;
    document.body.appendChild(a);
    a.click();
    document.body.removeChild(a);
    setTimeout(() => URL.revokeObjectURL(url), 100);

    // 4) Post to server—interpolate your file_id into JS:
    const fileId = '{/literal}{$file_id}{literal}';
    const form = new FormData();
    form.append('pdf_file', blob, filename);
    form.append('csrfp_token', document.querySelector('input[name="csrfp_token"]').value);

    const res = await fetch(`sign_document.php?id=${fileId}`, {
      method: 'POST',
      body: form
    });
    if (!res.ok) throw new Error(`Server error: ${await res.text()}`);
    const result = await res.json();
    if (result.success) {
      window.location.href = result.redirect_url;
    } else {
      throw new Error(result.message || 'Save failed');
    }

  } catch (err) {
    console.error('Error saving document:', err);
    alert('Error saving document: ' + err.message);
  } finally {
    document.getElementById('loading').style.display = 'none';
  }
});


function updateToolButtons() {
    const buttons = document.querySelectorAll('.toolbar button');
    buttons.forEach(button => button.classList.remove('active'));
    
    if (currentTool === 'signature') {
        document.getElementById('signatureBtn').classList.add('active');
    } else if (currentTool === 'text') {
        document.getElementById('textBtn').classList.add('active');
    }
}

// Load PDF when page loads
loadPDF();
{/literal}
</script>