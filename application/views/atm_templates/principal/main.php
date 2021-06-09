<div class="container mt-5" style="height: 500px;">
    <div class="row h-25">
        <div class="col-md-3"></div>
        <div class="col-md-6">
            <div class="form-outline form-white">
                <form id="fcuenta" action="verifica" method="POST">
                    <input hidden type="text" id="numCuenta" name="numCuenta"/>
                </form> 
                <input type="text" id="form1" class="form-control" />
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
        <div class="col-md-6"></div>
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
        var val = document.getElementById("form1").value;
        document.getElementById("numCuenta").value = val;
        document.getElementById("fcuenta").submit();
    }
</script>