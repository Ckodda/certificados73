const tingleMin = require("tingle.js");

// const { default: MicroModal } = require("micromodal");
var modal = new tingleMin.modal({
    footer: true,
    stickyFooter: false,
    closeMethods: ['overlay', 'button', 'escape'],
    closeLabel: "Close",
    cssClass: ['custom-class-1', 'custom-class-2'],
    onOpen: function() {
        // console.log('modal open');
    },
    onClose: function() {
        modal.setFooterContent('');
    },
    beforeClose: function() {

        return true;
    }
});

let btnAddCertificado = document.getElementById('btnAddCertificado');
let boxCertificados = document.getElementById('box-certificados');
let btnDeleteRowCert = document.getElementsByClassName('btnDeleteRowCert');
function refreshState(){
    btnAddCertificado = document.getElementById('btnAddCertificado');
    boxCertificados = document.getElementById('box-certificados');
    btnDeleteRowCert = document.getElementsByClassName('btnDeleteRowCert');
    console.log(boxCertificados);
}
function eventAdd(element, callback){
    
}
if(btnAddCertificado != undefined){

    btnAddCertificado.addEventListener('click', function () {
        let div = document.createElement('div');
        div.innerHTML =`<div class="row py-2">
            <div class="form-group col">
                    <label for="">Nombre de Curso o Diplomado</label>
                    <input type="text" name="nombreCertificado[]" placeholder="Nombre de Curso o Diplomado" class="form-control" id="">
                    </div>
                    <div class="form-group col">
                        <label for="">Archivo PDF</label>
                        <input type="file" name="file[]" placeholder="Suba un solo archivo" class="form-control" id="">
                    </div>
                    <div class="text-center col-md-2">
                    <button type="button" class="btn btn-sm btn-outline-danger btnDeleteRowCert">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x" viewBox="0 0 16 16">
                        <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
                        </svg>
                    </button>
                    </div>
                    
            </div>
            
        </div>`;

        boxCertificados.appendChild(div);
        refreshState();
        
    });

}

if(btnDeleteRowCert != undefined){
    Array.from(btnDeleteRowCert).forEach(function(e){
        e.addEventListener('click',function(e){
            e.target.closest('.row').remove();
            // console.log(e.target.closest('.row'));
            refreshState();
        });

    });
}

let formsDelete = document.getElementsByClassName('form-delete');

if(formsDelete != undefined ){

    Array.from(formsDelete).forEach((e)=>{
        // console.log({e});
        e.addEventListener('submit',function(e){
            e.preventDefault();
            modal.setContent('¿Seguro que desea eliminar el registro?');
            // add another button
            modal.addFooterBtn('ELiminar definitivamente', 'tingle-btn tingle-btn--danger', function() {
                // console.log({e});
                e.target.submit();
            });
            modal.addFooterBtn('Cancelar', 'tingle-btn tingle-btn--secondary', function() {
                // here goes some logic
                modal.close();
            });


            modal.open();
        });
    });
}