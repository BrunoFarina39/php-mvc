$(document).ready(function(){
 	$("#tabela_usuario,#tabela_cliente,#tabela_fornecedor,#tabela_marca,#tabela_produto,#tabela_servico").DataTable(
 		{"searching": false,
         "paging":false,
         "ordering":true,
         "info":true,
         "scrollY":"50vh",
         "scrollCollapse":true,
         "oLanguage": {
        	"sProcessing":"Processando...",
            "sLengthMenu":"Mostrar _MENU_ registros",
            "sZeroRecords":"Não foram encontrados resultados",
            "sInfo":"Mostrando de _START_ até _END_ de _TOTAL_ registros",
            "sInfoEmpty":"Mostrando de 0 até 0 de 0 registros",
            "sInfoFiltered":"",
            "sInfoPostFix":"",
            "sSearch":"Buscar:",
            "sUrl":"",
            "oPaginate":{
                "sFirst":"Primeiro",
                "sPrevious":"Anterior",
                "sNext":"Seguinte",
                "sLast":"Último"
                }
        	}
 	}); 
  $(function(){
    $('#preco_compra,#preco_venda,#preco,#salario').priceFormat({
      prefix: 'R$ ',
      centsSeparator: ',',
      thousandsSeparator: '.'
    });
  }); 
  //-------------------------------Usuário---------------------------------------------------------------------------
  /*$("#usuario_form").validate({
 		rules:{
 			login:{required:true, maxlength:30},
 			senha:{required:true,maxlength:20,minlength:8},//jquery reconhece os atributos html 5 como required,maxlength. Não sendo obrigatorio colocar nas rules
 			conf_senha:{required:true,equalTo:"#senha",maxlength:20,minlength:8},
 			nome:{required:true,maxlength:50},
 			nivel_scesso:"required"
 		},
 		messages:{
 			login:{required:"<span class='obrigatorio'>Digite o login</span>", maxlength:"<span class='obrigatorio'>Login não pode ter mais de 30 caracteres</span>"},
 			senha:{required:"<span class='obrigatorio'>Digite a senha</span>",maxlength:"<span class='obrigatorio'>Senha não pode ter mais de 20 caracteres</span>",
 				minlength:"<span class='obrigatorio'>Senha não pode ter menos de 8 caracteres</span>"},
 			conf_senha:{required:"<span class='obrigatorio'>Confirme a senha</span>",equalTo:"<span class='obrigatorio'>As senha devem serem iguais</span>",
 				maxlength:"<span class='obrigatorio'>Senha não pode ter mais de 20 caracteres</span>",minlength:"<span class='obrigatorio'>Senha não pode ter menos de 8 caracteres</span>"},
 			nome:{required:"<span class='obrigatorio'>Digite o nome</span>",maxlength:"<span class='obrigatorio'>Nome não pode ter mais de 50 caracteres</span>"},
 			nivel_acesso:"<span class='obrigatorio'>Informe um nível de acesso</span>"
 		}
 	});*/
    
 /*$("#altera_senha").validate({
    rules:{
      senha_atual:{required:true},
      senha:{required:true,maxlength:20,minlength:8},
      conf_senha:{required:true,equalTo:"#senha",maxlength:20,minlength:8}
    },
    messages:{
      senha_atual:{required:"<span class='obrigatorio'>Digite sua senha atual</span>"},
      senha:{required:"<span class='obrigatorio'>Digite a nova senha</span>", maxlength:"<span class='obrigatorio'>Senha não pode ter mais de 20 caracteres</span>", minlength:"<span class='obrigatorio'>Senha não pode ter menos de 8 caracteres</span>"},
      conf_senha:{required:"<span class='obrigatorio'>Confirme senha</span>",equalTo:"<span class='obrigatorio'>As senhas devem serem iguais</span>",
        maxlength:"<span class='obrigatorio'>Senha não pode ter mais de 20 caracteres</span>",minlength:"<span class='obrigatorio'>Senha não pode ter menos de 8 caracteres</span>"}
      }
  });*/
//-------------------------------Usuário Fim---------------------------------------------------------------------------
//-------------------------------Cliente-------------------------------------------------------------------------------
  /*$("#cliente_form").validate({
    rules:{
      nome:{required:true,maxlength:50},
      rg_ie:{maxlength:20},
      endereco:{maxlength:50},
      numero:{number:true},
      bairro:{maxlength:50},
      cidade:{required:true},
      obs:{maxlength:100}

      },           
      messages:{
          nome:{required:"<span class='obrigatorio'>Digite o nome</span>",maxlength:"<span class='obrigatorio'>Nome não pode ter mais de 50 caracteres</span>"},
          rg_ie:{maxlength:"<span class='obrigatorio'>RG/IE não pode ter mais de 20 caracteres</span>"},
          endereco:{maxlength:"<span class='obrigatorio'>Endereço não pode ter mais de 50 caracteres</span>"},
          numero:{number:"<span class='obrigatorio'>Digite apenas números</span>"},
          bairro:{maxlength:"<span class='obrigatorio'>Bairro não pode ter mais de 50 caracteres</span>"},
          cidade:{required:"<span class='obrigatorio'>Escolha uma cidade</span>"},
          obs:{maxlength:"<span class='obrigatorio'>Obs. não pode ter mais de 100 caracteres</span>"}
        } 
  });*/
//-------------------------------Cliente Fim---------------------------------------------------------------------------
//-------------------------------Fornecedor----------------------------------------------------------------------------
/* $("#fornecedor_form").validate({
    rules:{
      nome_fantasia:{required:true,maxlength:50},
      razao_social:{maxlength:50},
      rg_ie:{maxlength:20},
      endereco:{maxlength:50},
      numero:{number:true},
      bairro:{maxlength:50},
      cidade:{required:true},
      email:{maxlength:30,email:true},
      home_page:{maxlength:30},
      obs:{maxlength:100}

      },           
      messages:{
          nome_fantasia:{required:"<span class='obrigatorio'>Digite o nome fantasia</span>",maxlength:"<span class='obrigatorio'>Nome não pode ter mais de 50 caracteres</span>"},
          nome_fantasia:{required:"<span class='obrigatorio'>Digite a razão social</span>",maxlength:"<span class='obrigatorio'>Razão social não pode ter mais de 50 caracteres</span>"},
          rg_ie:{maxlength:"<span class='obrigatorio'>RG/IE não pode ter mais de 20 caracteres</span>"},
          endereco:{maxlength:"<span class='obrigatorio'>Endereço não pode ter mais de 50 caracteres</span>"},
          numero:{number:"<span class='obrigatorio'>Digite apenas números</span>"},
          bairro:{maxlength:"<span class='obrigatorio'>Bairro não pode ter mais de 50 caracteres</span>"},
          cidade:{required:"<span class='obrigatorio'>Escolha uma cidade</span>"},
          email:{maxlength:"<span class='obrigatorio'>Email não pode ter mais de 30 caracteres</span>",email:"<span class='obrigatorio'>Digite um email válido</span>"},
          home_page:{maxlength:"<span class='obrigatorio'>Home page não pode ter mais de 30 caracteres</span>"},
          obs:{maxlength:"<span class='obrigatorio'>Obs. não pode ter mais de 100 caracteres</span>"}
        } 
    });*/
   /* $("#compra_form").validate({
      rules:{
      fornecedor:"required",
      produto:"required",
      preco_compra:"required",
      qtde:{required:true,number:true},
      desconto:{required:true,number:true},
      },
      messages:{
      fornecedor:"<span class='obrigatorio'>Digite o fornecedor</span>",
      produto:"<span class='obrigatorio'>Digite o produto</span>",
      preco_compra:"<span class='obrigatorio'>Digite o preço de compra</span>",
      qtde:{required:"<span class='obrigatorio'>Digite a qtde</span>",number:"<span class='obrigatorio'>Digite apenas números</span>"},
      desconto:{required:"<span class='obrigatorio'>Digite a porcentagem de desconto</span>",number:"<span class='obrigatorio'>Digite apenas números</span>"},
      }
    });*/
//-------------------------------Fornecedor Fim------------------------------------------------------------------------  
//-------------------------------Cliente e Fornecedor------------------------------------------------------------------
  $("#cep").mask("99.999-999");
  $("#cpf_cnpj,#cpf").on('focusin',function(){
    var target = $(this);
    var val = target.val();
    target.unmask();
    val = val.split(".").join("");
    val = val.split("-").join("");
    val = val.split("/").join("");
    target.val(val);
  });
  $("#cpf_cnpj,#cpf").on('focusout',function(){
    var target = $(this);
    var val = target.val();
    var msgCpf = "<font color='red' font size='2px' font family='verdana'>CPF Inválido</font>";
    var msgCnpj = "<font color='red' font size='2px' font family='verdana'>CNPJ Inválido</font>";
    val = val.split(".").join("");
    val = val.split("-").join("");
    val = val.split("/").join("");
    if (val.length == 11) {
        target.mask("999.999.999-99");
        //target.val(val);
        $("#cpf_cnpj,#cpf") .rules ("remove");
        $("#cpf_cnpj,#cpf").rules( "add", {
            cpf: true,
            messages: {
              cpf:msgCpf
            } 
        });
    }else if (val.length == 14) {
        target.mask("99.999.999/9999-99");
        //target.val(val);
        $("#cpf_cnpj,#cpf") .rules ("remove");
        $("#cpf_cnpj,#cpf").rules( "add", {
            cnpj: true,
            messages: {
              cnpj:msgCnpj
            } 
        });
    }else if(val.length < 11) {
        $("#cpf_cnpj,#cpf") .rules ("remove");
        $("#cpf_cnpj,#cpf").rules( "add", {
            cpf: true,
            messages: {
              cpf:msgCpf
            } 
        });
    }else if(val.length > 11 && val.length < 14 || val.length > 14){
        $("#cpf_cnpj,#cpf") .rules ("remove");
        $("#cpf_cnpj,#cpf").rules( "add", {
            cnpj: true,
            messages: {
              cnpj:msgCnpj
            } 
        });
      } 
  });

 $("#fone,#fone2").focus(function(){
    var target = $(this);
    var val = target.val();
    target.unmask();
    val = val.split("-").join("");
    val = val.split("(").join("");
    val = val.split(")").join("");
    target.val(val);
  });
  $("#fone,#fone2").blur(function(){
    var target = $(this);
    var val = target.val();
    val = val.split("-").join("");
    val = val.split("(").join("");
    val = val.split(")").join("");
    if (val.length == 10) {
      
      target.mask("(99)9999-9999");
    }else if(val.length == 11) {
        
        target.mask("(99)99999-9999");
    }else{
      
      target.val("");
    } 
  });

  $("#carregar_cidade").html("<img src='public/imagens/load.gif'/>&nbsp;<span>Carregando cidade</span>");
  $("#estado").attr("disabled", true);
  $("#cidade").attr("disabled", true);
  $("#cliente_form button,#fornecedor_form button").attr("disabled", true);
  $.get("http://localhost/cliente/listarCidades/"+$("#estado").val(),
    function(dados){                    
      var cidadeId;
      $("#cidade").autocomplete({
        source: dados,
        minLength: 1,
        disabled:false, //autocomplete habilitado
        select: function(event, ui) {
          event.preventDefault()
          $("#cidade_id").val(ui.item.value);  
        },
        focus: function(event, ui) {
          event.preventDefault();
          $("#cidade").val(ui.item.label);
        }
      });
      $("#estado").attr("disabled", false);
      $("#cidade").attr("disabled", false);
      $("#cliente_form button,#fornecedor_form button").attr("disabled", false);
      $("#carregar_cidade").html("");
  },"json");
  $("#estado").change(function(){
    $("#carregar_cidade").html("<img src='public/imagens/load.gif'/>&nbsp;<span>Carregando cidade</span>");
    $("#estado").attr("disabled", true);
    $("#cidade").attr("disabled", true);
    $("#cliente_form button,#fornecedor_form button").attr("disabled", true);
    $.get("http://localhost/cliente/listarCidades/"+$("#estado").val(),
      function(dados){                    
        var cidadeId;
        $("#cidade").autocomplete({
            source: dados,
            minLength: 1,
            disabled:false, //autocomplete habilitado
            select: function(event, ui) {
              event.preventDefault()
              $("#cidade_id").val(ui.item.value);  
            },
            focus: function(event, ui) {
              event.preventDefault();
              $("#cidade").val(ui.item.label);
            }
        });
        $("#estado").attr("disabled", false);
        $("#cidade").attr("disabled", false);
        $("#cliente_form button,#fornecedor_form button").attr("disabled", false);
        $("#carregar_cidade").html("");
      },"json");
  });

  $("#cidade").click(function() {
    $(this).keypress(function(event){
      if(event.which == 8 || event.which == 0 ){
        $("#cidade").val("");
        $("#cidade_id").val("");
      }
    });
  });
//-------------------------------Cliente e Fornecedor Fim-------------------------------------------------------------
//----------------------------------------Marca-----------------------------------------------------------------------
$("#marca_form").validate({
  rules:{
    nome:{required:true}
  },
  messages:{
    nome:{required:"<span class='obrigatorio'>Digite o nome</span>"}
  }
 }); 
 //--------------------------------Marca Fim--------------------------------------------------------------------------- 
  $(window).scroll(function(){   
    //setaRodape();
  });
  setaRodape();
  window.onresize = setaRodape;
//--------------------------------Produto-----------------------------------------------------------------------------
  $("#carregar_marca").html("<img src='public/imagens/load.gif'/>&nbsp;<span>Carregando marca</span>");
  $("#marca").attr("disabled", true);
  $("#produto_form button").attr("disabled", true);
  $.get("http://localhost/produto/listarMarcas",
    function(dados){                    
      var marcaId;
      $("#marca").autocomplete({
          source: dados,
          minLength: 1,
          disabled:false, //autocomplete habilitado
          select: function(event, ui) {
            event.preventDefault()
            $("#marca_id").val(ui.item.value);  
          },
          focus: function(event, ui) {
            event.preventDefault();
            $("#marca").val(ui.item.label);
          }
      });
      $("#carregar_marca").html("");
      $("#marca").attr("disabled", false);
      $("#produto_form button").attr("disabled", false);
  },"json");

  $("#marca").click(function() {
    $(this).keypress(function(event){
      if(event.which == 8 || event.which == 0 ){
        $("#marca").val("");
        $("#marca_id").val("");
      }
    });
  });
  
//-------------------------------Produto Fim---------------------------------------------------------------------------
//---------------------------------Serviço-----------------------------------------------------------------------------
$("#preco").mask("R$");
//-------------------------------Movimentação de Compra----------------------------------------------------------------
  $("#carregar_fornecedor").html("<img src='public/imagens/load.gif'/>&nbsp;<span>Carregando Fornecedores</span>");
  $("#fornecedor").attr("disabled", true);
  $("#compra_form button").attr("disabled", true);
  $.get("http://localhost/compra/listarFornecedores",
    function(dados){                    
      var fornecedorId;
      $("#fornecedor").autocomplete({
          source: dados,
          minLength: 1,
          disabled:false, //autocomplete habilitado
          select: function(event, ui) {
            event.preventDefault()
            $("#fornecedor_id").val(ui.item.value);  
          },
          focus: function(event, ui) {
            event.preventDefault();
            $("#fornecedor").val(ui.item.label);
          }
      });
      $("#fornecedor").attr("disabled", false);
      $("#compra_form button").attr("disabled", false);
      $("#carregar_fornecedor").html("");
    },"json");

  $("#carregar_produto").html("<img src='public/imagens/load.gif'/>&nbsp;<span>Carregando Produtos</span>");
  $("#produto").attr("disabled", true);
  $("#compra_form button").attr("disabled", true);
  $.get("http://localhost/compra/listarProdutos",
    function(dados){                    
    var produtoId;
      $("#produto").autocomplete({
          source: dados,
          minLength: 1,
          disabled:false, //autocomplete habilitado
          select: function(event, ui) {
            event.preventDefault()
            $("#produto_id").val(ui.item.value);  
          },
          focus: function(event, ui) {
            event.preventDefault();
            $("#produto").val(ui.item.label);
          }
      });
      $("#produto").attr("disabled", false);
      $("#compra_form button").attr("disabled", false);
      $("#carregar_produto").html("");
    },"json");

  $("#estado").change(function(){
    $("#cidade").val("");
  });

  $("#produto").blur(function(){
    $("#carregar_produto_preco").html("<img src='public/imagens/load.gif'/>&nbsp;<span>Carregando Produtos</span>");
    $("#compra_form button").attr("disabled", true);
    $.get("http://localhost/compra/buscaPrecoCompra/"+$("#produto_id").val(),
      function(dados){
        $("#preco_compra").val(formataMoeda(dados.preco));
        $("#compra_form button").attr("disabled", false);
        $("#carregar_produto_preco").html("");    
    },"json");
    $("#preco_compra").attr("disabled", false);
  });

  var vTotalCompa=0;
  $("#adicionar").click(function(){
    if($("#compra_form").valid()){
      var produto = $("#produto").val();
      var produto_id = $("#produto_id").val();
      var qtde = $("#qtde").val();
      var preco = formataMoedaBD($("#preco_compra").val());
      var desconto = $("#desconto").val();
      var valorDesconto = ((qtde*preco)/100)*desconto;
      var valorTotal = (qtde*preco)-valorDesconto;
      vTotalCompa +=  valorTotal; 
      $("#valor_total").val(vTotalCompa.toFixed(2));
      $("#lvtotal").text(formataMoeda(vTotalCompa.toFixed(2)));
      $("#tabela_compra").append("<tbody><tr><td>"+produto_id+"</td>"+"<td>"+produto+"</td>"+
      "<td>"+$("#qtde").val()+"</td>"+"<td>"+$("#preco_compra").val()+"</td>"+
      "<td>"+desconto+"</td>"+"<td><a onclick='excluirProd(this)' href='javascript:void(0)'><span class='glyphicon glyphicon-trash'></span></a></td>"+
      "<td>"+formataMoeda(valorTotal.toFixed(2))+"</td></tr></tbody>");
     }
     $("#qtde").val(1);
     $("#produto").val("");
     $("#preco_compra").val("");
  });
  $("#avancar").click(function(){
    var i=0;
    var produtos = new String();
    $("#compra_form").unbind("submit");
    $("#tabela_compra > tbody").find('tr').each(function(indicex){
      i=+indicex+1;
      $(this).find('td').each(function(indicey){
        if(indicey != 5)
          produtos+=$(this).text()+"-";
      });
      produtos=produtos.substr(0,produtos.length-1)+"/";
    });
  
    if(i==0){
      //alert("Por Favor adicione pelo menos um produto");
     // $("#compra_form").submit(function(){
        //return false;
      //});
    }else{
      //retira o ultimo / da string
      produtos=produtos.substr(0,produtos.length-1)
      $("#produtos").val(produtos);
    }
  });
  
  $("#forma_pag").change(function(){
    if($(this).val()==1){
      $("#parcelas").val(1);
    }else{
      $("#parcelas").val(2)
    }
    $("#compra_form").submit();
  });

  $("#parcelas").change(function(){
    if($(this).val()!=1){
       $("#forma_pag").val(2);
     }else{
      $("#forma_pag").val(1);
     }
    $("#compra_form").submit();
  });
  $("#concluir").click(function(){
    $("#finalizar").val(true);
  });
});
//-------------------------------Document Jquery Fim------------------------------------------------------------------- 

$(window).load(function(){
  $(".load").fadeOut("slow")
});

function excluirProd(linha){
  linha.closest('tr').remove();
}

function excluir(url){
 	if(confirm("Deseja realmente excluir este registro?"))
    location.href=url;
}

function visualizaDadosCliente(id){
  $(function(){
    $("#load-visualize").addClass("load-visualize");
    $("#dialog").dialog({
      modal:true,
      height: 560,
      width: 500,
      title:"Dados do cliente",
      open:function(){
            $("#dialog > table").html("");
            $.get("http://localhost/cliente/visualizaClientePorId/"+id,
            function(dados){                    
              if(dados.rg_ie==null)
                dados.rg_ie="";
              if(dados.cpf_cnpj==null)
                dados.cpf_cnpj="";
              if(dados.endereco==null)
                dados.endereco="";
              if(dados.numero==null)
                dados.numero="";
              if(dados.bairro==null)
                dados.bairro="";
              if(dados.cep==null)
                dados.cep="";
              if(dados.fone==null)
                dados.fone="";
              if(dados.fone2==null)
                dados.fone2="";
              if(dados.obs==null)
                dados.obs="";
              $("#dialog > table").append("<thead><tr><td width='20%'><label>Código:</label></td><td>"+dados.id+"</td></tr>");
              $("#dialog > table").append("<tr><td><label>Nome:</label></td><td>"+dados.nome+"</td></tr>");
              $("#dialog > table").append("<tr><td><label>RG/IE:</label></td><td>"+dados.rg_ie+"</td></tr>");
              $("#dialog > table").append("<tr><td><label>CPF/CNPJ:</label></td><td>"+formataCpfCnpj(dados.cpf_cnpj)+"</td></tr>");
              $("#dialog > table").append("<tr><td><label>Endereço:</label></td><td>"+dados.endereco+"</td></tr>");
              $("#dialog > table").append("<tr><td><label>Número:</label></td><td>"+dados.numero+"</td></tr>");
              $("#dialog > table").append("<tr><td><label>Bairro:</label></td><td>"+dados.bairro+"</td></tr>");
              $("#dialog > table").append("<tr><td><label>CEP:</label></td><td>"+formataCep(dados.cep)+"</td></tr>");
              $("#dialog > table").append("<tr><td><label>Cidade:</label></td><td>"+dados.cid_nome+"-"+dados.est_uf+"</td></tr>");
              $("#dialog > table").append("<tr><td><label>Fone:</label></td><td>"+formataFone(dados.fone)+"</td></tr>");
              $("#dialog > table").append("<tr><td><label>Fone2:</label></td><td>"+formataFone(dados.fone2)+"</td></tr>");
              $("#dialog > table").append("<tr><td><label>Obs:</label></td><td>"+dados.obs+"</td></tr></thead>");
              $("#dialog > table").append("<tfoot><tr><td><button class='btn btn-default'>Imprimir</button></td><td>"
                +"<button class='btn btn-default'>Gerar PDF</button></td></tr></tfoot>");
              $("#load-visualize").removeClass("load-visualize");
          },"json");
        }
    });
  });
}

function visualizaDadosFornecedor(id){
  $(function(){
    $("#load-visualize").addClass("load-visualize");
    $("#dialog").dialog({
      modal:true,
      height: 560,
      width: 500,
      title:"Dados do fornecedor",
      open:function(){
            $("#dialog > table").html("");
            $.get("http://localhost/fornecedor/visualizaFornecedorPorId/"+id,
            function(dados){                    
              if(dados.razao_social==null)
                dados.razao_social="";
              if(dados.rg_ie==null)
                dados.rg_ie="";
              if(dados.cpf_cnpj==null)
                dados.cpf_cnpj="";
              if(dados.endereco==null)
                dados.endereco="";
              if(dados.numero==null)
                dados.numero="";
              if(dados.bairro==null)
                dados.bairro="";
              if(dados.cep==null)
                dados.cep="";
              if(dados.fone==null)
                dados.fone="";
              if(dados.fone2==null)
                dados.fone2="";
              if(dados.email==null)
                dados.email="";
              if(dados.home_page==null)
                dados.home_page="";
              if(dados.obs==null)
                dados.obs="";
              $("#dialog > table").append("<thead><tr><td width='20%'><label>Código:</label></td><td>"+dados.id+"</td></tr>");
              $("#dialog > table").append("<tr><td><label>Nome Fantasia:</label></td><td>"+dados.nome_fantasia+"</td></tr>");
              $("#dialog > table").append("<tr><td><label>Razão Social:</label></td><td>"+dados.razao_social+"</td></tr>");
              $("#dialog > table").append("<tr><td><label>RG/IE:</label></td><td>"+dados.rg_ie+"</td></tr>");
              $("#dialog > table").append("<tr><td><label>CPF/CNPJ:</label></td><td>"+formataCpfCnpj(dados.cpf_cnpj)+"</td></tr>");
              $("#dialog > table").append("<tr><td><label>Endereço:</label></td><td>"+dados.endereco+"</td></tr>");
              $("#dialog > table").append("<tr><td><label>Número:</label></td><td>"+dados.numero+"</td></tr>");
              $("#dialog > table").append("<tr><td><label>Bairro:</label></td><td>"+dados.bairro+"</td></tr>");
              $("#dialog > table").append("<tr><td><label>CEP:</label></td><td>"+formataCep(dados.cep)+"</td></tr>");
              $("#dialog > table").append("<tr><td><label>Cidade:</label></td><td>"+dados.cid_nome+"-"+dados.est_uf+"</td></tr>");
              $("#dialog > table").append("<tr><td><label>Fone:</label></td><td>"+formataFone(dados.fone)+"</td></tr>");
              $("#dialog > table").append("<tr><td><label>Fone2:</label></td><td>"+formataFone(dados.fone2)+"</td></tr>");
              $("#dialog > table").append("<tr><td><label>Email:</label></td><td>"+dados.email+"</td></tr>");
              $("#dialog > table").append("<tr><td><label>Home Page:</label></td><td>"+dados.home_page+"</td></tr>");
              $("#dialog > table").append("<tr><td><label>Obs:</label></td><td>"+dados.obs+"</td></tr></thead>");
              $("#dialog > table").append("<tfoot><tr><td><button class='btn btn-default'>Imprimir</button></td><td>"
                +"<button class='btn btn-default'>Gerar PDF</button></td></tr></tfoot>");
              $("#load-visualize").removeClass("load-visualize");
          },"json");
        }
    });
  });
}

function visualizaDadosProduto(id){
  $(function(){
    $("#load-visualize").addClass("load-visualize");
    $("#dialog").dialog({
      modal:true,
      height: 560,
      width: 500,
      title:"Dados do produto",
      open:function(){
            $("#dialog > table").html("");
            $.get("http://localhost/produto/visualizaProdutoPorId/"+id,
            function(dados){                    
              if(dados.cod_barra==null)
                dados.cod_barra=""
              $("#dialog > table").append("<thead><tr><td width='20%'><label>Código:</label></td><td>"+dados.id+"</td></tr>");
              $("#dialog > table").append("<tr><td><label>Código de barras:</label></td><td>"+dados.cod_barra+"</td></tr>");
              $("#dialog > table").append("<tr><td><label>Descrição:</label></td><td>"+dados.descricao+"</td></tr>");
              $("#dialog > table").append("<tr><td><label>Marca:</label></td><td>"+dados.marca+"</td></tr>");
              $("#dialog > table").append("<tr><td><label>Preço Compra:</label></td><td>"+formataMoeda(dados.preco_compra)+"</td></tr>");
              $("#dialog > table").append("<tr><td><label>Preço Venda:</label></td><td>"+formataMoeda(dados.preco_venda)+"</td></tr>");
              $("#dialog > table").append("<tr><td><label>Qtde. Est.:</label></td><td>"+dados.qtde_est+"</td></tr>");
              $("#dialog > table").append("<tfoot><tr><td><button class='btn btn-default'>Imprimir</button></td><td>"
                +"<button class='btn btn-default'>Gerar PDF</button></td></tr></tfoot>");
              $("#load-visualize").removeClass("load-visualize");
          },"json");
        }
    });
  });
}

function visualizaDadosFuncionario(id){
  $(function(){
    $("#load-visualize").addClass("load-visualize");
    $("#dialog").dialog({
      modal:true,
      height: 560,
      width: 500,
      title:"Dados de funcionário",
      open:function(){
            $("#dialog > table").html("");
            $.get("http://localhost/funcionario/visualizaFuncionarioPorId/"+id,
            function(dados){                    
              if(dados.rg==null)
                dados.rg="";
              if(dados.cpf==null)
                dados.cpf="";
              if(dados.pis==null)
                dados.pis="";
              if(dados.endereco==null)
                dados.endereco="";
              if(dados.numero==null)
                dados.numero="";
              if(dados.bairro==null)
                dados.bairro="";
              if(dados.cep==null)
                dados.cep="";
              if(dados.fone==null)
                dados.fone="";
              if(dados.salario==null)
                dados.salario="";
              $("#dialog > table").append("<thead><tr><td width='20%'><label>Código:</label></td><td>"+dados.id+"</td></tr>");
              $("#dialog > table").append("<tr><td><label>Nome:</label></td><td>"+dados.nome+"</td></tr>");
              $("#dialog > table").append("<tr><td><label>Rg:</label></td><td>"+dados.rg+"</td></tr>");
              $("#dialog > table").append("<tr><td><label>CPF:</label></td><td>"+formataCpfCnpj(dados.cpf)+"</td></tr>");
              $("#dialog > table").append("<tr><td><label>Pis:</label></td><td>"+dados.pis+"</td></tr>");
              $("#dialog > table").append("<tr><td><label>Endereço:</label></td><td>"+dados.endereco+"</td></tr>");
              $("#dialog > table").append("<tr><td><label>Número:</label></td><td>"+dados.numero+"</td></tr>");
              $("#dialog > table").append("<tr><td><label>Bairro:</label></td><td>"+dados.bairro+"</td></tr>");
              $("#dialog > table").append("<tr><td><label>CEP:</label></td><td>"+formataCep(dados.cep)+"</td></tr>");
              $("#dialog > table").append("<tr><td><label>Cidade:</label></td><td>"+dados.cid_nome+"-"+dados.est_uf+"</td></tr>");
              $("#dialog > table").append("<tr><td><label>Fone:</label></td><td>"+formataFone(dados.fone)+"</td></tr>");
              $("#dialog > table").append("<tr><td><label>Salario:</label></td><td>"+formataMoeda(dados.salario)+"</td></tr>");
              $("#dialog > table").append("<tfoot><tr><td><button class='btn btn-default'>Imprimir</button></td><td>"
                +"<button class='btn btn-default'>Gerar PDF</button></td></tr></tfoot>");
              $("#load-visualize").removeClass("load-visualize");
          },"json");
        }
    });
  });
}

function formataCpfCnpj(insc){
  tamanho = insc.length;
  var part;
  if(tamanho == 11){
    part = insc.substr(0,3)+".";
    part+= insc.substr(3,3)+".";
    part+= insc.substr(6,3)+"-";
    part+= insc.substr(9,2);
  }else if(tamanho == 14){
    part = insc.substr(0,2)+".";
    part+= insc.substr(2,3)+".";
    part+= insc.substr(5,3)+"/";
    part+= insc.substr(8,4)+"-";
    part+= insc.substr(12,2);
  }else{
    return insc;
  }
  return part;
}

function formataCep(cep){
  if(cep.length == 8){
    part = cep.substr(0,2)+".";
    part += cep.substr(2,3)+"-";
    part += cep.substr(5,3);
    return part;
  }else{
    return cep;
  }
}

function formataFone(fone){
  tamanho = fone.length;
  if(tamanho == 10){
    part = fone.substr(0,0)+"(";
    part += fone.substr(0,2)+")";
    part += fone.substr(2,4)+"-";
    part += fone.substr(6,4);
    return part;
  }else if(tamanho == 11){
    part = fone.substr(0,0)+"(";
    part += fone.substr(0,2)+")";
    part += fone.substr(2,5)+"-";
    part += fone.substr(7,4);
    return part;
  }else{
    return fone;
  }
}

function formataMoeda(valor)
{
  if(valor == "")
    return "";
  if(typeof valor === 'number'){
    valor=String(valor);
  }
  valor = valor.split("R$").join("");
  valor = valor.split(".").join("");
  valor = valor.split(",").join("");
  moeda = valor.substr(0,valor.length-2)+",";
  moeda += valor.substr(valor.length-2);
  array = moeda.split(",");
  switch(array[0].length){
    case 4:
      part = moeda.substr(0,1)+".";
      part += moeda.substr(1); 
      break;
    case 5:
      part = moeda.substr(0,2)+".";
      part += moeda.substr(2);
      break;
    case 6:
      part = moeda.substr(0,3)+".";
      part += moeda.substr(3);
      break;
    default : part = moeda;       
  }
  return "R$ "+part;
}

function formataMoedaBD(valor){
  valor = valor.split("R$").join("");
  valor = valor.split(" ").join("");
  valor = valor.split(".").join("");
  valor = valor.split(",").join("");
  moeda = valor.substr(0,valor.length-2)+".";
  moeda += valor.substr(valor.length-2);
  return moeda;
}

function setaRodape(){
  var body = $(document.body)[0].scrollHeight;
  var janela = $(window).height();
    if(body > janela){ 
      $("#footer").css("position","static");
    }else{ 
      $("#footer").css("position","fixed");///https://pt.stackoverflow.com/questions/63253/rodap%C3%A9-grudado-no-fim-da-p%C3%A1gina-e-responsivo-altura-vari%C3%A1vel-usando-bootstr
      //alert('fixo');
    }
    $('#footer').css('bottom',0); 
    };

setInterval(function(){
  $(".alert").fadeOut(1000,function(){
    setaRodape();
  });
}, 3000);