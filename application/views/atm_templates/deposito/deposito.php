<div class="container mt-5" style="height: 500px;">
    <div class="row h-25">
        <div class="col-md-3"></div>
        <div class="col-md-6">
            <h6 class="text-center">Ingresa el monto que deseas depositar a tu cuenta</h6>
            <div class="form-outline form-white">
                <form id="fmonto" action="realizaDeposito" method="POST">
                    <input hidden type="text" id="monto" value="" name="monto"/>
                </form> 
                <input type="text" id="form1" class="form-control" />
                <label class="form-label" for="form1">$mxn</label>
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
                    realizar depósito
                </button>
            </div>
        </div>
    </div>
</div>

<script>
    function enviaMonto(){
        var val = document.getElementById("form1").value;
        const monto = document.getElementById("monto").value = val;
        document.getElementById("fmonto").submit();
    }
</script>