/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


  $(document).ready(function (){
               $('.realizado').click(function(event){
                   var boton = $(this);
                   var idTarea=$(this).val();
                    $.ajax({
                        url: "index.php?controller=tarea&action=realizado",
                        data: {"idTarea":idTarea},
                        method: "POST",
                        success: function(result){
                            console.log(result);
                            boton.attr("disabled", true);
                            boton.append(" <span class='glyphicon glyphicon-ok'></span>");
                        }
                    });           
                }); 
                

                $('.notas').click(function(){
                   var boton=$(this);
                   boton.next().append('<div class="añadirNotas"><div><form method="post" class="form_notas"><hr/>Añadir nota: <textarea name="nota" class="form-control"></textarea></form><button class="btn btn-success submitNota">Añadir</button>&nbsp;<button class="btn btn-primary cerrarNota">Cerrar</button></div>');
                   $('.form_notas').attr('action','index.php?controller=nota&action=alta&idTarea='+boton.val());
                });
      
                $('body').on('click','.submitNota',function(){//para los componentes generados dinamicamente
                    var datos = $(this).prev().serialize();
                    var formulario = $(this).prev();
                    var btn=$(this);
                    $.ajax({
                        type:formulario.attr('method'), 
                        url: formulario.attr('action'),
                        data: datos,
                        success: function (data) { 
                            var form=formulario.parent();
                            cerrarAñadirNota(form);
                        } 
                    });
                });
                
                
                
                $('body').on('click','.cerrarNota',function(){//para los componentes generados dinamicamente
                     var formulario = $(this).parent().parent();
                     var btn=$(this);
                     cerrarAñadirNota(formulario);
                       
                });
                
                function cerrarAñadirNota(formulario){
                    formulario.remove();
                }
                  
                $('.mostrarNotas').hide();
                
                $('.verNotas').click(function(){ 
                   var idTarea=$(this).val();
                   var posicionarmeDom=$(this).next().next().next();
                   $.ajax({
                        method: 'POST', 
                        url: 'index.php?controller=nota&action=mostrarNotas',
                        data: {"idTarea": idTarea},
                        success: function (datos) { 
                            console.log(datos);
                            var notas=jQuery.parseJSON(datos);
                            
                            notas.forEach(function(nota){
                                      posicionarmeDom.children('ul').append('<li value="'+nota.idNota+'">'+nota.descripcion+'&nbsp;&nbsp;<span class="glyphicon glyphicon-trash listadoNotas" ></span></li>');  
                            });  
                        } 
                   });

                   posicionarmeDom.show();
                   
                });
                
                $('.x').click(function(){ 
                   $(this).parent().parent().children('ul').empty();
                   $(this).parent().parent().hide();
                });
                
                $('body').on('click','.listadoNotas', function(){
                    var li=$(this).parent();
                    var idNota=$(this).parent().val();
                    $.ajax({
                        url:"index.php?controller=nota&action=delete&idNota="+idNota,
                        method:"GET",
                        success: function(result){
                            console.log(result);
                            li.remove();
                        }
                    });
                    
                });
                
                $('#alertInfo').hide();
                
                /*$('#invitar').click(function(event){
                    event.preventDefault();
                    var form = $(this).parent().parent();
                    var datos = form.serialize();
                    $.ajax({
                        url: form.attr('action'),
                        method:form.attr('method'),
                        data: datos,
                        success:function(result) {
                           console.log(result);
                           $('#alertInfo').show();
                           $('#alertInfo').delay(2000).hide(600); 
                        }
                    });
                    
                    
                        
                        
                        
                        
                    
                    
                    
                });*/
                
}); 
