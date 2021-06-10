<div class="container mt-5" style="height: 500px;">
    <div class="row h-25">
        <div class="col-md-3"><p id="log"></p></div>
        <div class="col-md-6">
            <h6 class="text-center">Ingresa el monto que deseas retirar de tu cuenta (mínimo $50, máximo $15000)</h6>
            <div class="form-outline form-white">
                <form id="fmonto" action="realizaRetiro" method="POST">
                    <input hidden required type="number" min="50" max="15000"id="monto" name="monto"/>
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
                    realizar retiro
                </button>
            </div>
        </div>
    </div>
</div>

<script>
    function enviaMonto(){
        var form = document.getElementById("fmonto");
        var val = document.getElementById("form1").value;
        document.getElementById("monto").value = val;
        if(form.checkValidity()){
            form.submit();
        }
        else{
            alert("Monto inválido");
        }
    }
</script>
