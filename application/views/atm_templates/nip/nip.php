<div class="container mt-5" style="height: 500px;">
    <div class="row h-25">
        <div class="col-md-3"></div>
        <div class="col-md-6">
            <h6 class="text-center">Bienvenido <?php echo  $nombreCh; ?></h6>
            <div class="form-outline form-white">
                <form id="fcuenta" action="verifica" method="POST">
                    <input hidden required min="1000" max="9999" type="number" id="nip" name="nip"/>
                </form>
                <input type="text" maxlength="4" id="form1" class="form-control" />
                <label class="form-label" for="form1">NIP</label>
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
            <form class="d-grid" id="form-regresar" action="regresaMain">
                <button class="btn btn-green" type="submit">
                    antetior
                </button>
            </form>
        </div>
        <div class="col-md-6"></div>
        <div class="col-md-3 d-grid">
            <button class="btn btn-green" type="button" onclick="enviaNip()">
                siguiente
            </button>
        </div>
    </div>
</div>

<script>
    function enviaNip(){
        var form = document.getElementById("fcuenta");
        const val = document.getElementById("form1").value;
        document.getElementById("nip").value = val;
        if(form.checkValidity()){
            form.submit();
        }
        else{
            alert("Datos incorrectos");
        }
    }
</script>
