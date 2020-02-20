{literal}
<script type="text/javascript">
  document.addEventListener("DOMContentLoaded", function(event) {
    const applyFee = document.querySelector("#applyMerchantFee") ? true : false;

    if(!applyFee) return;
    
    var totalAmount = document.querySelector(".total_amount-section div:first-of-type")
      .textContent
      .trim()
      .split("\n");

    console.log(totalAmount[1]);

  });
</script>
{/literal}
