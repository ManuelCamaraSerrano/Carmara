$(document).ready(function(){
    const btnAbrirArch = $("#csv");
    var textUsuarios =$("#alta_masiva_form_password");
    
    btnAbrirArch.change(readFile);

    function readFile(evt) {
        let file = evt.target.files[0];
        let reader = new FileReader();
        reader.onload = (e) => {
          // Cuando el archivo se terminó de cargar
          let lines = parseCSV(e.target.result);
          var texto= "";
          for(let i=0; i<lines.length; i++)
          {
              if(i==(lines.length)-1){
                texto = texto+lines[i]
              }
              else{
                texto = texto+lines[i]+"\n";
              }
              
          }
          textUsuarios.text(texto);
        };
        // Leemos el contenido del archivo seleccionado
        reader.readAsBinaryString(file);
      }

      function parseCSV(text) {
        // Obtenemos las lineas del texto
        let lines = text.replace(/\r/g, '').split('\n');
        
        return lines.map(line => {
          // Por cada linea obtenemos los valores
          let values = line.split(',');
          return values;
        });
      }
})