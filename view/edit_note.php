<?php
$id = $producto = $total=$importe = "";

if(isset($dataToView["data"]["id"])) $id = $dataToView["data"]["id"];
if(isset($dataToView["data"]["producto"])) $producto = $dataToView["data"]["producto"];
if(isset($dataToView["data"]["importe"])) $importe = $dataToView["data"]["importe"];
if(isset($dataToView["data"]["total"])) $total = $dataToView["data"]["total"];

?>
<div class="row">
	 
	<form class="form" action="index.php?controller=note&action=save" method="POST">
		<input type="hidden" name="id" value="<?php echo $id; ?>" />
		 
		<div class="form-group mb-2">
			<label>Valor 1</label>
			<input type="number" class="form-control" onkeydown="calcularConEnter(event)" style="white-space: pre-wrap;" id="valor1" name="valor1"><?php echo $importe; ?></input>				
		</div>
		<div class="form-group mb-2">
			<label>Respuesta</label>

			<textarea class="form-control" style="white-space: pre-wrap;" name="total" id="total"><?php echo $total; ?></textarea>
		</div>
		
	</form>
</div>


<script>
        function calcularConEnter(event) {
            calcularFactorial();
        }

        function calcularFactorial() { 
        	var mensaje="";
 			 var val1 = parseFloat(document.getElementById('valor1').value);
             if (isNaN(val1) || val1 < 0) {
               mensaje = "Ingresa un número válido y no negativo.";
                return;
            }

            let factorial = 1;
            let calculoFactorial = `${val1}! = `;
            for (let i = 1; i <= val1; i++) {
                factorial *= i;
                if (i === 1) {
                    calculoFactorial += i;
                } else {
                    calculoFactorial += ` * ${i}`;
                }
            }

            mensaje = `El factorial de ${val1} es igual a ${factorial}  `;
            mensaje += `Cálculo del factorial de ${val1}:${calculoFactorial}`;
             document.getElementById('total').value = mensaje;
        }

        
    </script>