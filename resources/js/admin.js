
let btnAddCertificado = document.getElementById('btnAddCertificado');
let boxCertificados = document.getElementById('box-certificados');
// console.log({boxCertificados})
let index = 1;
btnAddCertificado.addEventListener('click', function () {
    index++;
    // console.log(boxCertificados);
    boxCertificados.innerHTML = boxCertificados.innerHTML + `
    <div class="row py-2">
    <div class="form-group col">
              <label for="">Nombre de Curso o Diplomado</label>
              <input type="text" name="certificado${index + 1}" placeholder="Nombre de Curso o Diplomado" class="form-control" id="">
            </div>
            <div class="form-group col">
              <label for="">Archivo PDF</label>
              <input type="file" name="file${index+1}" placeholder="Suba un solo archivo" class="form-control" id="">
            </div>
    </div>
    </div>
    `;
});