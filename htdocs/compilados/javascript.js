
(function() {
  Grass = function() {
    return this;
  };
  Grass.prototype= {
    alto_hierba: 0,    // grass height
    maxAngle:    0,    // maximum grass rotation angle (wind movement)
    angle:       0,    // construction angle. thus, every grass is different to others  
    coords:      null,  // quadric bezier curves coordinates
    color:       null,  // grass color. modified by ambient component.
    offset_control_point:   3,    // grass base width. greater values, wider at the basement.
    initialize : function(canvasWidth, canvasHeight, minHeight, maxHeight, angleMax, initialMaxAngle)  {
      var sx= Math.floor( Math.random()*canvasWidth );
      var sy= canvasHeight;
      var offset_control_x=1.5;  
      this.alto_hierba= minHeight+Math.random()*maxHeight;
      this.maxAngle= 10+Math.random()*angleMax;
      this.angle= Math.random()*initialMaxAngle*(Math.random()<0.5?1:-1)*Math.PI/180;
      var csx= sx-offset_control_x ;
      var csy= 0;
      if ( Math.random()<0.1 ) {
        csy= sy-this.alto_hierba;
      } else {
        csy= sy-this.alto_hierba/2;
      }
      var psx= csx;
      var psy= csy-offset_control_x;
      this.offset_control_point=3;
      var dx= sx+this.offset_control_point;
      var dy= sy;      
      this.coords= [sx,sy,csx,csy,psx,psy,dx,dy];
      this.color= [16+Math.floor(Math.random()*32),
                   100+Math.floor(Math.random()*155),
                   16+Math.floor(Math.random()*32) ];
    },
    paint : function(ctx,time,ambient) {
          ctx.save();
          var inc_punta_hierba= Math.sin(time*0.0005);
          var ang= this.angle + Math.PI/2 + inc_punta_hierba * Math.PI/180*(this.maxAngle*Math.cos(time*0.0002));
          var px= this.coords[0]+ this.offset_control_point + this.alto_hierba*Math.cos(ang);
          var py= this.coords[1]                  - this.alto_hierba*Math.sin(ang);
          var c= this.coords;
          ctx.beginPath();
          ctx.moveTo( c[0], c[1] );
          ctx.bezierCurveTo(c[0], c[1], c[2], c[3], px, py);
          ctx.bezierCurveTo(px, py, c[4], c[5], c[6], c[7]);
          ctx.closePath();
          ctx.fillStyle='rgb('+
              Math.floor(this.color[0]*ambient)+','+
              Math.floor(this.color[1]*ambient)+','+
              Math.floor(this.color[2]*ambient)+')';
          ctx.fill();
          ctx.restore();
    }  
  };
})();
(function() {
  Garden= function() {
    return this;
  };
  Garden.prototype= {
    grass:      null,
    ambient:    1,
    stars:      null,
    firefly_radius:  10,
    num_fireflyes:  40,
    num_stars:    512,
    width:      0,
    height:      0,
    initialize : function(width, height, size)  {
      this.width= width;
      this.height= height;
      this.grass= [];
      for(var i=0; i<size; i++ ) {
        var g= new Grass();
        g.initialize(
            width,
            height,
            50,      // min grass height 
            height*2/3, // max grass height
            20,     // grass max initial random angle 
            40      // max random angle for animation 
            );
        this.grass.push(g);
      }
      this.stars= [];
      for( i=0; i<this.num_stars; i++ )  {
        this.stars.push( Math.floor( Math.random()*(width-10)+5  ) );
        this.stars.push( Math.floor( Math.random()*(height-10)+5 ) );
      }
    },
    paint : function(ctx, time){
      ctx.save();
      if ( this.ambient<0.3 )  {
        ctx.globalAlpha= 1-((this.ambient-0.05)/0.25);
        intensity= 1 - (this.ambient/2-0.05)/0.25;
        var c= Math.floor( 192*intensity );
        var strc= 'rgb('+c+','+c+','+c+')';
        ctx.strokeStyle=strc;
        for( var j=this.num_fireflyes*2; j<this.stars.length; j+=2 )  {
          var inc=1;
          if ( j%3===0 ) {
            inc=1.5;
          } else if ( j%11===0 ) {
            inc=2.5;
          }
          this.stars[j]= (this.stars[j]+0.1*inc)%canvas.width;
          var y= this.stars[j+1];
          ctx.strokeRect(this.stars[j],this.stars[j+1],1,1);
        }
      }
      ctx.globalAlpha= 1;
      var i;
        ctx.fillStyle= '#ffff00';      
        for(i=0; i<this.num_fireflyes*2; i+=2) {
          var angle= Math.PI*2*Math.sin(time*3E-4) + i*Math.PI/50;
          var radius= this.firefly_radius*Math.cos(time*3E-4);
          ctx.fillRect( 
              this.width/2 + 
              0.5*this.stars[i] + 
              150*Math.cos(time*3E-4) * Math.sin(time*0.00001*i) +  // move horizontally with time 
              radius*Math.cos(angle),
              this.height/2 + 
              0.5*this.stars[i+1] +  
              20*Math.sin(time*3E-4) * 5* Math.cos(time*0.00001*i)+  // move vertically with time 
              radius*Math.sin(angle),
                3,
                3 );
        }            
      for(i=0; i<this.grass.length; i++ ) {
        this.grass[i].paint(ctx,time,this.ambient);
      }
      ctx.restore();
    }
  };
})();
    function _doit()    {
      ctx.fillStyle= gradient;
      ctx.fillRect(0,0,canvas.width,canvas.height);
      var ntime= new Date().getTime();
      var elapsed= ntime-time;
      garden.paint( ctx, elapsed );
      if ( elapsed>nextLerpTime ) {
        lerpindex= Math.floor((elapsed-nextLerpTime)/nextLerpTime);
        if ( (elapsed-nextLerpTime)%nextLerpTime<lerpTime ) {
          lerp( (elapsed-nextLerpTime)%nextLerpTime, lerpTime );
        }
      }
    }
    function lerp( time, last ) {
      gradient= ctx.createLinearGradient(0,0,0,canvas.height);
      var i0= lerpindex%colors.length;
      var i1= (lerpindex+1)%colors.length;
      for( var i=0; i<4; i++ )  {
        var rgb='rgb(';
        for( var j=0; j<3; j++ ) {
          rgb+= Math.floor( (colors[i1][i*3+j]-colors[i0][i*3+j])*time/last + colors[i0][i*3+j]);
          if ( j<2 ) rgb+=',';
        }
        rgb+=')';
        gradient.addColorStop( i/3, rgb );
      }
      garden.ambient= (ambients[i1]-ambients[i0])*time/last + ambients[i0];
    }
var lerpTime= 10000;    // time taken to fade sky colors
var nextLerpTime= 15000;  // after fading, how much time to wait to fade colors again.
var interval= null;
var canvas= null;
var ctx= null;
var garden= null;
var gradient;
var time;
    function init(images) {
        canvas= document.getElementById('s');
        ctx= canvas.getContext('2d');
        canvas.width= 1000;
        canvas.height=300;
        garden= new Garden();
        garden.initialize(canvas.width, canvas.height, 100);
        lerp(0,2000);
        time= new Date().getTime();
        interval = setInterval(_doit, 60);
    }
    colors= [ [ 0x00, 0x00, 0x3f, 
            0x00, 0x3f, 0x7f,
            0x1f, 0x5f, 0xc0,
            0x3f, 0xa0, 0xff ],
          [ 0x00, 0x3f, 0x7f, 
            0xa0, 0x5f, 0x7f,
            0xff, 0x90, 0xe0,
            0xff, 0x90, 0x00 ],
          [ 0x00, 0x00, 0x00,
            0x00, 0x2f, 0x7f,
            0x00, 0x28, 0x50,
            0x00, 0x1f, 0x3f ],
            [ 0x1f, 0x00, 0x5f,
              0x3f, 0x2f, 0xa0,
              0xa0, 0x1f, 0x1f,
              0xff, 0x7f, 0x00 ] ];
    ambients= [ 1, 0.35, 0.05, 0.5 ];
    lerpindex= 0;
window.addEventListener(
    'load',
    init(null),
    false);
function atualizar_conteudo_elemento_bloco(identificador){
valor = document.getElementById("textarea_editar_conteudo_elemento_bloco_" + identificador).value;
if($('#nome_usuario_editar_elemento_bloco_' + identificador).length > 0){
nome_usuario = document.getElementById("nome_usuario_editar_elemento_bloco_" + identificador).value;
}else{
nome_usuario = "";
};
if($('#data_editar_elemento_bloco_' + identificador).length > 0){
data = document.getElementById("data_editar_elemento_bloco_" + identificador).value;
}else{
data = "";
};
$.post(v_pagina_acoes, {nome_usuario: nome_usuario, data: data, valor: valor, id: identificador, tipo_elemento: v_href , href: 15}, function(retorno){
location.reload();
});
};
function carrega_conteudo_bloco(){
if(v_id_funcionario.length != 0){
return null;
};
$.post(v_pagina_acoes, {id_funcionario: v_id_funcionario, contador_avanco_conteudo: v_contador_avanco_bloco, href: v_href }, function(retorno){
if(retorno != -1 && v_bkp_conteudo_bloco != retorno && retorno.length > 0){
$(retorno).appendTo('#id_div_bloco_pagina');
v_contador_avanco_bloco++;
v_bkp_conteudo_bloco = retorno;
};
});
};
function criar_enquete(){
conteudo = document.getElementById("id_campo_conteudo_enquete").value;
$.post(v_pagina_acoes, {conteudo: conteudo, href: 12}, function(retorno){
location.reload();
});
};
function cria_direcao(){
conteudo = document.getElementById("id_campo_conteudo_direcao").value;
$.post(v_pagina_acoes, {conteudo: conteudo, href: 13}, function(retorno){
location.reload();
});
};
function excluir_elemento_bloco(identificador){
$.post(v_pagina_acoes, {id: identificador, tipo_elemento: v_href , href: 14}, function(retorno){
document.getElementById("id_div_conteudo_bloco_" + identificador).style.display = "none";
});
};
function salvar_comunicado(){
conteudo = document.getElementById("id_campo_conteudo_comunicado").value;
$.post(v_pagina_acoes, {conteudo: conteudo, href: 9}, function(retorno){
location.reload();
});
};
function salvar_telefones_uteis(){
conteudo = document.getElementById("id_campo_conteudo_telefones").value;
$.post(v_pagina_acoes, {conteudo: conteudo, href: 10}, function(retorno){
location.reload();
});
};
function votar_enquete(id, voto){
$.post(v_pagina_acoes, {id: id, voto: voto, href: 31}, function(retorno){
document.getElementById("id_div_votar_enquete_bloco_" + id).innerHTML = retorno;
});
};
function cadastro_usuario(){
var email = document.getElementById("id_email_login").value;
var senha = document.getElementById("id_senha_login").value;
$.post(v_pagina_acoes, {href: 1, email: email, senha: senha}, function(retorno){
if(retorno == 1){
location.reload();
}else{
document.getElementById("id_mensagem_login_cadastro").innerHTML = retorno;
};
});
};
function abrir_janela_conversa_chat(){
$.post(v_pagina_acoes, {href: 46}, function(retorno){
if(retorno == true){
document.getElementById("id_div_janela_conversa_chat_usuario").style.display = "inline";
}else{
document.getElementById("id_div_janela_conversa_chat_usuario").style.display = "none";
};
});
};
function alterar_senha_usuario(){
senha_atual = document.getElementById("campo_altera_senha_atual").value;
nova_senha = document.getElementById("campo_altera_senha_nova").value;
nova_senha_confirma = document.getElementById("campo_altera_senha_confirma").value;
$.post(v_pagina_acoes, {nova_senha_confirma: nova_senha_confirma, nova_senha: nova_senha, senha_atual: senha_atual, href: 47}, function(retorno){
location.reload();
});
};
function carregar_historico_chat(){
$.post(v_pagina_acoes, {contador_avanco_chat: contador_avanco_historico_chat, href: 43}, function(retorno){
if(retorno != -1){
$(retorno).appendTo('#id_div_mensagens_historico_chat');
contador_avanco_historico_chat += v_limit_chat_usuario;
};
});
};
function carrega_atualizacoes_chat(){
carrega_numero_usuarios_online_chat();
carrega_conversas_chat();
carrega_informacoes_usuario_chat();
abrir_janela_conversa_chat();
usuario_online_offline_chat();
};
function carrega_conversas_chat(){
$.post(v_pagina_acoes, {dataType : "json", contador_avanco_chat: contador_avanco_mensagens_chat, href: 41}, function(retorno){
var objeto = jQuery.parseJSON(retorno);
var conteudo = objeto['conteudo'];
var contador = objeto['contador'];
if(contador_avanco_mensagens_chat == 0){
contador_avanco_mensagens_chat = contador;
};
if(parseInt(conteudo) != -1){
contador_avanco_mensagens_chat += v_limit_chat_conversas;
$(conteudo).appendTo('#id_div_conversas_usuario_chat');
move_scroll_conversas_chat();
};
});
};
function carrega_informacoes_usuario_chat(){
$.post(v_pagina_acoes, {dataType : "json", href: 42}, function(retorno){
var objeto = jQuery.parseJSON(retorno);
var nome = objeto['nome'];
var online_offline = objeto['online_offline'];
document.getElementById("id_span_nome_usuario_conversando").innerHTML = nome;
document.getElementById("id_span_online_offline_usuario_conversando").innerHTML = online_offline;
});
};
function carrega_numero_usuarios_online_chat(){
$.post(v_pagina_acoes, {href: 36}, function(retorno){
document.getElementById("id_span_num_usuarios_online_chat").innerHTML = retorno;
});
};
function constroe_lista_usuarios_chat(){
$.post(v_pagina_acoes, {contador_avanco_chat: contador_avanco_chat, dataType : "json", href: 37}, function(retorno){
var objeto = jQuery.parseJSON(retorno);
var conteudo = objeto['conteudo'];
var ids_usuarios = objeto['ids_usuarios'];
for(index = 0; index < ids_usuarios.length; index++) {
var idamigo = parseInt(ids_usuarios[index]);
if(array_usuarios_chat.indexOf(parseInt(idamigo)) == -1 && idamigo != 0){
array_usuarios_chat[index] = idamigo;
};
};
if(conteudo.length != 0){
contador_avanco_chat += v_limit_chat_usuario;
};
if(document.getElementById("id_div_chat_usuario_amigos_chat").innerHTML != null){
$(conteudo).appendTo('#id_div_chat_usuario_amigos_chat');
}else{
document.getElementById("id_div_chat_usuario_amigos_chat").innerHTML = conteudo;
};
});
};
function enviar_conversa_chat(){
conteudo = document.getElementById("id_campo_entrada_conversa_chat").value;
if(conteudo.length == 0){
return false;
};
$.post(v_pagina_acoes, {conteudo: conteudo, href: 39}, function(retorno){
document.getElementById("id_campo_entrada_conversa_chat").value = "";
document.getElementById("id_campo_entrada_conversa_chat").focus();
});
};
function excluir_historico_chat(){
$.post(v_pagina_acoes, {href: 44}, function(retorno){
contador_avanco_mensagens_chat = 0;
document.getElementById("id_div_conversas_usuario_chat").innerHTML = "";
document.getElementById("id_div_mensagens_historico_chat").innerHTML = "";
document.getElementById("id_campo_entrada_conversa_chat").focus();
document.getElementById("id_campo_entrada_conversa_chat").value = "";
contador_avanco_historico_chat = 0;
fechar_janela_mensagem_dialogo();
});
};
function fechar_janela_conversa_chat(){
$.post(v_pagina_acoes, {href: 45}, function(retorno){
document.getElementById("id_div_janela_conversa_chat_usuario").style.display = "none";
});
};
function minimiza_janela_chat_usuario(){
if(document.getElementById("id_div_chat_usuario_amigos_chat").style.display.length == 0){
document.getElementById("id_div_chat_usuario_amigos_chat").style.display = "none";
document.getElementById("id_div_amigos_usuario_chat").style.display = "none";
document.getElementById("id_div_chat_usuario_opcoes").style.bottom = 0;
};
if(document.getElementById("id_div_chat_usuario_amigos_chat").style.display != "none"){
document.getElementById("id_div_chat_usuario_amigos_chat").style.display = "none";
document.getElementById("id_div_amigos_usuario_chat").style.display = "none";
document.getElementById("id_div_chat_usuario_opcoes").style.bottom = 0;
}else{
document.getElementById("id_div_chat_usuario_amigos_chat").style.display = "inline";
document.getElementById("id_div_amigos_usuario_chat").style.display = "inline";
document.getElementById("id_div_chat_usuario_opcoes").style.bottom = 460;
};
};
function move_scroll_conversas_chat(){
var objDiv = document.getElementById("id_div_conversas_usuario_chat");
objDiv.scrollTop = objDiv.scrollHeight;
};
function seta_usuario_chat(idusuario){
$.post(v_pagina_acoes, {uid: idusuario, href: 40}, function(retorno){
contador_avanco_mensagens_chat = 0;
document.getElementById("id_div_conversas_usuario_chat").innerHTML = "";
document.getElementById("id_div_mensagens_historico_chat").innerHTML = "";
document.getElementById("id_campo_entrada_conversa_chat").value = "";
contador_avanco_historico_chat = 0;
document.getElementById("id_div_janela_conversa_chat_usuario").style.display = "inline";
document.getElementById("id_campo_entrada_conversa_chat").focus();
});
};
function usuario_online_offline_chat(){
for(index = 0; index < array_usuarios_chat.length; index++) {
var idamigo = parseInt(array_usuarios_chat[index]);
if(idamigo != null){
$.post(v_pagina_acoes, {uid: idamigo, href: 38, dataType : "json"}, function(retorno){
var objeto = jQuery.parseJSON(retorno);
var conteudo = objeto['conteudo'];
var idusuario = objeto['idusuario'];
var numero_mensagens = objeto['numero_mensagens'];
document.getElementById("id_div_usuario_online_offline_" + idusuario).innerHTML = conteudo;
document.getElementById("id_numero_novas_mensagens_usuario_" + idusuario).innerHTML = numero_mensagens;
if(numero_mensagens > 0){
document.getElementById("id_numero_novas_mensagens_usuario_" + idusuario).style.display = "inline";
}else{
document.getElementById("id_numero_novas_mensagens_usuario_" + idusuario).style.display = "none";
};
});
};
};
};
function atualiza_conexao_usuario(){
$.post(v_pagina_acoes, {href: 35}, function(retorno){
});
};
function carrega_conteudo(){
carrega_publicacoes_miniatura();
};
function dialogo_editar_elemento_bloco(identificador){
procedimentos_inicia_dialogo();
document.getElementById("id_dialogo_editar_elemento_bloco_" + identificador).style.display = "inline";
};
function dialogo_editar_perfil_excluir_conta(){
procedimentos_inicia_dialogo();
document.getElementById("dialogo_editar_perfil_excluir_conta").style.display = "inline";
};
function dialogo_editar_perfil_usuario(){
procedimentos_inicia_dialogo();
document.getElementById("dialogo_editar_perfil_usuario").style.display = "inline";
};
function dialogo_editar_perfil_usuario_imagem(){
procedimentos_inicia_dialogo();
document.getElementById("dialogo_editar_perfil_usuario_imagem").style.display = "inline";
};
function dialogo_editar_perfil_usuario_informacoes(){
procedimentos_inicia_dialogo();
document.getElementById("dialogo_editar_perfil_usuario_informacoes").style.display = "inline";
};
function dialogo_editar_perfil_usuario_senha(){
procedimentos_inicia_dialogo();
document.getElementById("dialogo_editar_perfil_usuario_senha").style.display = "inline";
};
function dialogo_excluir_elemento_bloco(identificador){
procedimentos_inicia_dialogo();
document.getElementById("id_dialogo_excluir_elemento_bloco_" + identificador).style.display = "inline";
};
function dialogo_excluir_funcionario(id_funcionario){
procedimentos_inicia_dialogo();
document.getElementById("id_dialogo_excluir_funcionario_" + id_funcionario).style.display = "inline";
};
function dialogo_excluir_imagem_publicacao(identificador){
procedimentos_inicia_dialogo();
document.getElementById("dialogo_excluir_imagem_publicacao_" + identificador).style.display = "inline";
};
function dialogo_excluir_imagem_slideshow(identificador){
procedimentos_inicia_dialogo();
document.getElementById("dialogo_excluir_imagem_slideshow_" + identificador).style.display = "inline";
};
function dialogo_excluir_publicacao(identificador){
procedimentos_inicia_dialogo();
document.getElementById("id_dialogo_excluir_publicacao_" + identificador).style.display = "inline";
};
function dialogo_historico_conversa_chat(){
procedimentos_inicia_dialogo();
contador_avanco_historico_chat = 0;
document.getElementById("id_div_mensagens_historico_chat").innerHTML = "";
document.getElementById("id_dialogo_historico_conversas").style.display = "inline";
carregar_historico_chat();
};
function dialogo_limpar_historico_chat(){
procedimentos_inicia_dialogo();
document.getElementById("id_dialogo_historico_conversas_limpar").style.display = "inline";
};
function fechar_janela_mensagem_dialogo(){
var numero_janelas = document.getElementsByClassName("div_janela_principal_mensagem_dialogo").length;
for(contador = 0; contador <= numero_janelas; contador++){
document.getElementsByClassName("div_janela_principal_mensagem_dialogo")[contador].style.display = "none";
};
};
function janela_mensagem_dialogo_excluir_album(identificador){
procedimentos_inicia_dialogo();
document.getElementById("div_excluir_album_" + identificador).style.display = "inline";
};
function procedimentos_inicia_dialogo(){
};
function cadastra_funcionario(){
nome = document.getElementById("campo_nome_cad_funcionario").value;
cargo = document.getElementById("campo_cargo_cad_funcionario").value;
hora_inicio = document.getElementById("campo_hora_entra_cad_funcionario").value;
hora_fim = document.getElementById("campo_hora_sai_cad_funcionario").value;
hora_pausa_inicio = document.getElementById("campo_hora_pausa_inicio_cad_funcionario").value;
hora_pausa_fim = document.getElementById("campo_hora_pausa_fim_cad_funcionario").value;
$.post(v_pagina_acoes, {nome: nome, cargo: cargo, hora_inicio: hora_inicio, hora_fim: hora_fim, hora_pausa_inicio: hora_pausa_inicio, hora_pausa_fim: hora_pausa_fim, href: 19}, function(retorno){
if(retorno != -1){
location.reload();
};
});
};
function excluir_funcionario(id_funcionario){
$.post(v_pagina_acoes, {id_funcionario: id_funcionario, href: 22}, function(retorno){
location.reload();
});
};
function dialogo_excluir_imagem_galeria(identificador){
procedimentos_inicia_dialogo();
document.getElementById("id_dialogo_excluir_imagem_galeria_" + identificador).style.display = "inline";
};
function excluir_imagem_galeria_imagens(id){
$.post(v_pagina_acoes, {id: id, href: 18}, function(retorno){
document.getElementById("id_div_conteudo_galeria_imagens_" + id).style.display = "none";
});
};
function salvar_descricao_imagem_galeria(id){
conteudo = document.getElementById("id_campo_conteudo_descricao_imagem_galeria_" + id).value;
$.post(v_pagina_acoes, {id: id, conteudo: conteudo, href: 17}, function(retorno){
});
};
function sessao_idioma_atualizar(modo){
$.post(v_pagina_acoes, {modo: modo, href: 49}, function(retorno){
location.reload();
});
};
function exibe_campos_login_usuario(){
document.getElementById("id_div_formulario_login_campos").style.display = "inline";
};
function logar_usuario(){
var email = document.getElementById("id_email_login").value;
var senha = document.getElementById("id_senha_login").value;
$.post(v_pagina_acoes, {href: 2, email: email, senha: senha}, function(retorno){
if(retorno == 1){
location.reload();
}else{
document.getElementById("id_mensagem_login_cadastro").innerHTML = retorno;
};
});
};
function atualizar_publicacao(id){
titulo = document.getElementById("id_publicacao_titulo_" + id).value;
conteudo = document.getElementById("id_publicacao_conteudo_" + id).value;
$.post(v_pagina_acoes, {idpost: id, titulo: titulo, conteudo: conteudo, href: 25}, function(retorno){
location.reload();
});
};
function carrega_publicacoes_miniatura(){
if($("#id_div_campo_destaque").length == 0){
return false;
};
$.post(v_pagina_acoes, {pesq: pesq, contador_avanco_conteudo: v_contador_avanco_publicacoes, href: 7}, function(retorno){
if(retorno != -1 && v_bkp_miniatura_destaque != retorno && retorno.length > 0){
v_contador_avanco_publicacoes++;
v_bkp_miniatura_destaque = retorno;
$(retorno).appendTo('#id_div_campo_destaque');
};
});
};
function excluir_imagem_publicacao(id){
$.post(v_pagina_acoes, {id: id, href: 26}, function(retorno){
document.getElementById("div_imagem_publicacao_" + id).style.display = "none";
});
fechar_janela_mensagem_dialogo();
};
function excluir_publicacao(id){
$.post(v_pagina_acoes, {idpost: id, href: 23}, function(retorno){
location.reload();
});
};
function visualizar_imagens_upload_postagem() {
document.getElementById("div_imagens_pre_publicacao").style.display = "table";
var files = elemento_file_campo_publicar.files;
for(var i = 0, f; f = files[i]; i++) {
if(!f.type.match('image.*')) {
continue;
}
var reader = new FileReader();
reader.onload = (function(theFile) {
return function(e) {
var div = document.createElement('div');
div.innerHTML = ['<img class="classe_imagem_pre_upload_post" src="', e.target.result, '"/>'].join('');
document.getElementById('div_imagens_pre_publicacao').insertBefore(div, null);
};
})
(f);
reader.readAsDataURL(f);
}
}
function seleciona_imagens_publicacao_usuario(){
document.getElementById("div_imagens_pre_publicacao").innerHTML = "";
document.getElementById("elemento_file_campo_publicar").value = "";
document.getElementById("elemento_file_campo_publicar").click();
};
function detecta_resolucao_pagina(){
var largura = window.innerWidth;
$.post(v_pagina_acoes, {largura: largura, href: 50}, function(retorno){
if(retorno == 1){
location.reload();
};
});
};
function atualizar_descricao_imagem_slideshow(id){
var comentario = document.getElementById("id_campo_comentario_imagem_slideshow").value;
$.post(v_pagina_acoes, {id: id, comentario: comentario, href: 6}, function(retorno){
});
};
function avanca_slideshow(modo){
pausar_slideshow(0);
if(modo == 2 && v_contador_slideshow >= 2){
v_contador_slideshow -= 2;
};
if(v_contador_slideshow >= 0){
carregar_slideshow();
};
};
function carregar_slideshow(){
if(v_slideshow_pausado == 1){
return null;
};
$.post(v_pagina_acoes, {dataType : "json", contador_avanco_conteudo: v_contador_slideshow, href: 5}, function(retorno){
var objeto = jQuery.parseJSON(retorno);
if(objeto['imagem'] == -1){
v_contador_slideshow = 0;
}else{
v_contador_slideshow++;
};
if(objeto['imagem'] != -1){
document.getElementById("id_div_slide_show_imagem").innerHTML = objeto['imagem'];
document.getElementById("id_div_slide_show_comentario").innerHTML = objeto['comentario'];
};
});
};
function excluir_imagem_slideshow(id){
$.post(v_pagina_acoes, {id: id, href: 27}, function(retorno){
location.reload();
});
};
function pausar_slideshow(modo){
v_slideshow_pausado = modo;
};
function excluir_conta_usuario(){
senha_atual = document.getElementById("campo_senha_excluir_conta").value;
$.post(v_pagina_acoes, {senha_atual: senha_atual, href: 48}, function(retorno){
location.reload();
});
};
function recuperar_conta_usuario(){
email = document.getElementById("campo_email_recuperar_conta_usuario").value;
$.post(v_pagina_acoes, {email: email, href: 51}, function(retorno){
if(retorno != -1){
alert(retorno);
};
location.reload();
});
};
function salvar_perfil_usuario(){
nome_perfil_salvar = document.getElementById("id_nome_perfil_salvar").value;
endereco_perfil_salvar = document.getElementById("id_endereco_perfil_salvar").value;
cidade_perfil_salvar = document.getElementById("id_cidade_perfil_salvar").value;
estado_perfil_salvar = document.getElementById("id_estado_perfil_salvar").value;
telefone_perfil_salvar = document.getElementById("id_telefone_perfil_salvar").value;
$.post(v_pagina_acoes, {nome_perfil_salvar, endereco_perfil_salvar, cidade_perfil_salvar, estado_perfil_salvar, telefone_perfil_salvar, href: 32}, function(retorno){
location.reload();
});
};
function salva_widget(){
conteudo = document.getElementById("id_campo_textarea_widget").value;
$.post(v_pagina_acoes, {conteudo: conteudo, href: 52}, function(retorno){
});
};
