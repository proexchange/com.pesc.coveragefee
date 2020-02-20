<div class="crm-public-form-item crm-section coveragefee-section coveragefee">
  {foreach from=$coverageFeeElements item=coverageFeeElement}
    <div class="label">Coverage Fee (1.5%)</div>
    <div class="content">{$form.$coverageFeeElement.html}</div>
  {/foreach}
  <div class="clear"></div>
</div>
