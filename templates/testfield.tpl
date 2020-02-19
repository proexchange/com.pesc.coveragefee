<div class="crm-section merchant_fee-section">
  <div class="label">&nbsp;</div>
  <div class="content">
    {$form.merchant_fee.html}
  </div>
  <div class="clear"></div>
</div>

{literal}
<script type="text/javascript"> 
  document.addEventListener("DOMContentLoaded", function(event) {
    var percentage = parseFloat(3.00).toFixed(2);
    var total = parseFloat(document.querySelector("#pricesetTotal #pricevalue")
      .textContent
      .substr(2)
      .trim()).toFixed(2);
    var fee = parseFloat(total * (percentage / 100)).toFixed(2);
    var newTotal = (parseFloat(total) + parseFloat(fee)).toFixed(2);

    document.querySelector('#merchant_fee_1').addEventListener('change', function(event) {
      var checked = event.target.checked;
      if(checked) {
        document.querySelector("#pricesetTotal #pricelabel").classList.remove("hiddenElement");
        document.querySelector("#pricesetTotal #pricevalue").style.display = "block"; 
        document.querySelector("#pricesetTotal #pricevalue").innerHTML = `<b>$</b> ${newTotal}`;
      }
      else {
        document.querySelector("#pricesetTotal #pricelabel").classList.add("hiddenElement");
        document.querySelector("#pricesetTotal #pricevalue").style.display = "none";
        document.querySelector("#pricesetTotal #pricevalue").innerHTML = `<b>$</b> ${total}`;
      }
    });
  });
{/literal}
</script>
