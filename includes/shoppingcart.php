<?PHP
	Class ShoppingCart
	{
		var $arrayCart 				  = array();
		var $arrayCartProductcode     = array();
		var $arrayCartProductQuantity = array();
		var $arrayCartCurrentTime     = array();
		var $arrayCartProductSize     = array();
		var $arrayCartProductColor    = array();
		var $arrayCartProductAddOn    = array();
		var $shippngCost		      = array();

		function Initialize($cartValues)
		{
			if(is_array($cartValues))
			{
				$this->arrayCart = $cartValues;
				$this->arrayCartProductCode = $this->arrayCart[0];
				$this->arrayCartProductQuantity = $this->arrayCart[1];
				$this->arrayCartCurrentTime = $this->arrayCart[2];
				$this->arrayCartProductSize = $this->arrayCart[3];
				$this->arrayCartProductColor = $this->arrayCart[4];
				$this->arrayCartProductAddOn = $this->arrayCart[5];
				$this->shippngCost	= $this->arrayCart[6];
			}
		}

		function ReInitialize()
		{
			unset($this->arrayCart);
			$this->arrayCart[] = array_values($this->arrayCartProductCode);
			$this->arrayCart[] = array_values($this->arrayCartProductQuantity);
			$this->arrayCart[] = array_values($this->arrayCartCurrentTime);
			$this->arrayCart[] = array_values($this->arrayCartProductSize);
			$this->arrayCart[] = array_values($this->arrayCartProductColor);
			$this->arrayCart[] = array_values($this->arrayCartProductAddOn);
			$this->arrayCart[] = array_values($this->shippngCost);
		}
		
		function Update($ProductCode, $ItemQuantity)
		{
			$elementKey = array_search($ProductCode, $this->arrayCartProductcode);
			$this->arrayCartProductQuantity[$elementKey] = $ItemQuantity;
			$this->ReInitialize();
		}
		
		function Add($ProductCode, $ItemQuantity, $size, $color, $ship_price, $addon, $addon1)
		{	
			if((in_array($ProductCode, $this->arrayCartProductCode)) && (in_array($Variations, $this->arrayCartProductVariations)))
			{
				$elementKey = array_search($ProductCode, $this->arrayCartProductCode);
				$ItemQuantity = $ItemQuantity+$this->arrayCartProductQuantity[$elementKey];
				$this->arrayCartProductQuantity[$elementKey] = $ItemQuantity;
				if($addon != "") {
					$this->arrayCartProductAddOn[$elementKey] = $addon1;
				} 
				else {
					$this->arrayCartProductAddOn[$elementKey] = "";
				}
			}
			
			else 
			{
				$this->arrayCartProductCode[] = $ProductCode;
				$this->arrayCartProductQuantity[] = $ItemQuantity;
				$this->arrayCartCurrentTime[] = strtotime("now");
				$this->arrayCartProductSize[] = $size;
				$this->arrayCartProductColor[] = $color;
				$this->arrayCartProductAddOn[] = $addon1;
				$this->shippngCost[] = $ship_price;
			}
			print_r($this->arrayCartProductAddOn);
			$this->ReInitialize();
		}
			
		/*function Add($ProductCode,$ItemQuantity,$Variations)
		{
			$this->arrayCartProductCode[] = $ProductCode;
			$this->arrayCartProductQuantity[] = $ItemQuantity;
			$this->arrayCartCurrentTime[] = strtotime("now");
			$this->arrayCartProductVariations[] = $Variations;

			$this->ReInitialize();
		}*/

		function Remove($ProductCode,$timestamp)
		{
			if(in_array($ProductCode, $this->arrayCartProductCode))			
			{
				$elementKey = array_search($timestamp, $this->arrayCartCurrentTime);
				unset($this->arrayCartProductCode[$elementKey]);
				unset($this->arrayCartProductQuantity[$elementKey]);
				unset($this->arrayCartCurrentTime[$elementKey]);
				unset($this->arrayCartProductSize[$elementKey]);
				unset($this->arrayCartProductColor[$elementKey]);
				unset($this->arrayCartProductAddOn[$elementKey]);
				unset($this->shippngCost[$elementKey]);
				$this->ReInitialize();
			}
		}

		function ItemsInCart()
		{
			$items = 0;
			foreach($this->arrayCartProductQuantity AS $key=>$value)
			{
				$items += $value;
			}
			return $items;
		}

		function CartValues()
		{
			return $this->arrayCart;
		}
		function TCartValues()
		{
			return $this->arrayCartProductQuantity;
		}
	}
?>