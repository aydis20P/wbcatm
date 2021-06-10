<div class="container mt-5" style="height: 500px;">
    <div class="row h-25">
        <div class="col-md-3"><p id="log"></p></div>
        <div class="col-md-6">
            <form id="fmonto" action="realizaTransferencia" method="POST">
                <input hidden required type="number" min="50" max="15000" id="monto" name="monto"/>
                <input hidden required type="number" id="numcuenta" name="numcuenta"/>
            </form>
            <h6 class="text-center">Ingresa el monto a transferir (mínimo $50, máximo $15000)</h6>
            <div class="form-outline form-white">
                <input type="text" maxlength="16" id="form1" class="form-control" />
                <label class="form-label" for="form1">$mxn</label>
            </div>
            <h6 class="text-center">Ingresa el número de cuenta</h6>
            <div class="form-outline form-white">
                <input type="text" id="form2" class="form-control" />
                <label class="form-label" for="form2">Número de cuenta del beneficiario</label>
            </div>
        </div>
        <div class="col-md-3"></div>
    </div>
    <div class="row h-25">
        <div class="col-md-3"></div>
        <div class="col-md-6"></div>
        <div class="col-md-3"></div>
    </div>
    <div class="row h-25">
    <div class="col-md-3"></div>
        <div class="col-md-6"></div>
        <div class="col-md-3"></div>
    </div>
    <div class="row h-25">
        <div class="col-md-3 d-grid mb-2">
            <form class="d-grid" id="form-regresar" action="regresar">
                <button class="btn btn-green" type="submit">
                    antetior
                </button>
            </form>
        </div>
        <div class="col-md-6"></div>
        <div class="col-md-3 d-grid mb-2">
            <div class="d-grid">
                <button class="btn btn-green" type="button" onclick="enviaMonto()">
                    realizar transferencia
                </button>
            </div>
        </div>
    </div>
</div>

<script>
    function enviaMonto(){
        var form = document.getElementById("fmonto");

        var monto = document.getElementById("form1").value;
        document.getElementById("monto").value = monto;

        var numcuenta = document.getElementById("form2").value;
        document.getElementById("numcuenta").value = numcuenta;
        if(form.checkValidity()){
            form.submit();
        }
        else{
            alert("Datos inválidos");
        }
    }
</script>
