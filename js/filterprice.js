(function ($) {
  
    $('#price-range-submit').hide();
  
      $("#min_price,#max_price").on('change', function () {
  
        $('#price-range-submit').show();
  
        var min_price_range = parseInt($("#min_price").val());
  
        var max_price_range = parseInt($("#max_price").val());
  
        if (min_price_range > max_price_range) {
          $('#max_price').val(min_price_range);
        }
  
        $("#slider-range").slider({
          values: [min_price_range, max_price_range]
        });
        
      });
  
  
      $("#min_price,#max_price").on("paste keyup", function () {                                        
  
        $('#price-range-submit').show();
  
        var min_price_range = parseInt($("#min_price").val());
  
        var max_price_range = parseInt($("#max_price").val());
        
        if(min_price_range == max_price_range){
  
              max_price_range = min_price_range + 100;
              
              $("#min_price").val(min_price_range);		
              $("#max_price").val(max_price_range);
        }
  
        $("#slider-range").slider({
          values: [min_price_range, max_price_range]
        });
  
      });
  
      /*$("#slider-range,#price-range-submit").click(function () {
  
        var min_price = $('#min_price').val();
        var max_price = $('#max_price').val();
  
        $("#searchResults").text("Here List of products will be shown which are cost between " + min_price  +" "+ "and" + " "+ max_price + ".");
      });*/
  
    
  })(jQuery);