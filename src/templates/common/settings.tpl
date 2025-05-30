        <form action="settings.php" method="POST" enctype="multipart/form-data" id="settingsForm">    
        <table class="form-table">        
            <tr>
                <th>{$g_lang_label_name}</th><th>{$g_lang_value}</th><th>{$g_lang_label_description}</th>
            </tr>
            {foreach from=$settings_array item=i}
            <tr>
                <td>{$i.name|escape:'html'}</td>
                <td>
                {if $i.validation eq 'bool'}
                    <select name="{$i.name|escape:'html'}">
                        <option value="True" {if $i.value eq 'True'} selected="selected"{/if}>True</option>
                        <option value="False" {if $i.value eq 'False'} selected="selected"{/if}>False</option>
                    </select>
                {elseif $i.name eq 'theme'}
                    <select name="theme">
                        {foreach from=$themes item=theme}
                            <option value="{$theme|escape}" {if $i.value eq $theme}selected="selected"{/if}>{$theme|escape:'html'}</option>
                        {/foreach}
                    </select>
                {elseif $i.name eq 'language'}
                    <select name="language">
                        {foreach from=$languages item=language}
                            <option value="{$language|escape}" {if $i.value eq $language} selected="selected"{/if}>{$language|escape:'html'}</option>
                        {/foreach}
                    </select>
                {elseif $i.name eq 'file_expired_action'}
                    <select name="file_expired_action">
                        <option value="1" {if $i.value eq '1'}selected="selected"{/if}>Remove from file list until renewed</option>
                        <option value="2" {if $i.value eq '2'}selected="selected"{/if}>Show in file list but non-checkoutable</option>
                        <option value="3" {if $i.value eq '3'}selected="selected"{/if}>Send email to reviewer only</option>
                        <option value="4" {if $i.value eq '4'}selected="selected"{/if}>Do Nothing</option>
                    </select>
                {elseif $i.name eq 'authen'}
                    <select name="authen">
                        <option value="mysql" {if $i.value eq 'mysql'}selected="selected"{/if}>MySQL</option>
                    </select>
                {elseif $i.name eq 'root_id'}
                    <select name="root_id">
                        {foreach from=$useridnums item=useridnum}
                            <option value="{$useridnum[0]|escape}" {if $i.value eq $useridnum[0]} selected="selected"{/if}>{$useridnum[1]|escape:'html'}</option>
                        {/foreach}
                    </select>
                {elseif $i.name eq 'smtp_password'}
                    <input size="40" name="{$i.name|escape}" type="password" value="{$i.value|escape:'html'}">
                {else}
                    <input size="40" name="{$i.name|escape}" type="text" value="{$i.value|escape:'html'}">
                {/if}
                </td>
                <td><em>{$i.description|escape:'html'}</em></td>
            </tr>
            {/foreach}
            <tr>
                <td colspan="3" align="center">
                    <div class="buttons">
                        <button class="positive" type="submit" name="submit" value="Save">{$g_lang_button_save}</button>
                        <button class="negative" type="submit" name="submit" value="Cancel">{$g_lang_button_cancel}</button>
                    </div>
                </td>
            </tr>
        </table>
        </form>