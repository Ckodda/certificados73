
let btnAddCertificado = document.getElementById('btnAddCertificado');
let boxCertificados = document.getElementById('box-certificados');

btnAddCertificado.addEventListener('click', function () {
    
    
    boxCertificados.innerHTML = boxCertificados.innerHTML + `
    <div class="row py-2">
        <div class="form-group col">
                <label for="">Nombre de Curso o Diplomado</label>
                <input type="text" name="nombreCertificado[]" placeholder="Nombre de Curso o Diplomado" class="form-control" id="">
                </div>
                <div class="form-group col">
                <label for="">Archivo PDF</label>
                <input type="file" name="file[]" placeholder="Suba un solo archivo" class="form-control" id="">
                </div>
        </div>
    </div>
    `;
});