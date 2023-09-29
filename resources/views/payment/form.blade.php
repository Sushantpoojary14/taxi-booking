<html>
<head>
<script>
	window.onload = function() {
		var d = new Date().getTime();
		document.getElementById("tid").value = d;
	};
</script>
</head>
<body>
 
	<form method="post" name="customerData" action="{{url('/redirect')}}">
	    @csrf
		            <input type="hidden" name="tid" id="tid"  />
                    <input type="hidden" name="merchant_id" value="2382476"/>
                    <input type="hidden" name="order_id" value="{{$order_id}}"/>
                    <input type="hidden" name="amount" value="{{$customer->total_amount}}"/>
                    <input type="hidden" name="currency" value="INR"/>
                    <input type="hidden" name="redirect_url" value="https://yohtaxi.com/response"/>
                    <input type="hidden" name="cancel_url" value="https://yohtaxi.com/response"/>
                    <input type="hidden" name="language" value="EN"/>
                    <input type="hidden" name="billing_name" value="{{$customer->fullname}}"/>
                    <input type="hidden" name="billing_tel" value="{{$customer->phone}}"/>
                    <input type="hidden" name="merchant_param1" value="{{$customer->id}}"/>
                    <input type="hidden" name="merchant_param2" value="{{$category}}"/>
	      </form>
	      <script language='javascript'>
	      document.customerData.submit();
	      </script>
	</body>
</html>


