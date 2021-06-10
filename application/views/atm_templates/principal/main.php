<div class="container mt-5" style="height: 500px;">
    <div class="row h-25">
        <div class="col-md-3"></div>
        <div class="col-md-6">
            <div class="form-outline form-white">
                <form id="fcuenta" action="verifica" method="POST">
                    <input hidden required type="number" id="numCuenta" name="numCuenta"/>
                </form>
                <input type="text" maxlength="16" id="form1" class="form-control" />
                <label class="form-label" for="form1">Ingrese su núemro de cuenta</label>
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
        <div class="col-md-6"></p></div>
        <div class="col-md-3"></div>
    </div>
    <div class="row h-25">
        <div class="col-md-3"></div>
        <div class="col-md-6"></div>
        <div class="col-md-3 d-grid">
            <button class="btn btn-green" type="button" onclick="enviaNumCuenta()">
                siguiente
            </button>
        </div>
    </div>
</div>

<script>
    function enviaNumCuenta(){
        var form = document.getElementById("fcuenta");
        const val = document.getElementById("form1").value;
        document.getElementById("numCuenta").value = val;
        if(form.checkValidity()){
            form.submit();
        }
        else{
            alert("Datos incorrectos");
        }
    }
</script>
