    var rfidform = ''+
        '<form id"rfid">'+
        '<div class="modal-body icon-rfid">'+
        '<center>'+
        '<img src="img/scan-rfid.gif">'+
        '</center>'+
        '</div>'+
        '</form>';
//buat object
var RFID = (function(){
  //ctor
  function self(){}
  var url = '/rfid';
  //ajax request
  self.Request = function (params){
    var xhr = $.ajax({
      context     : params.context,  //pemberitahuan RFID
      dataType    : params.datatype || "json",
      ContentType : params.contentType || "application/json",
      type        : params.verb || "GET",
      data        : params.data || {},
      async       : params.async || false,
      processData : params.processData || true,
      url         : params.url || url,
      global      : params.global || true,
      timeout     : params.waktu | 5000
    })
    .error(onError)
    .done(function(data, textStatus, jqXHR){
      console.log("Start Local ==================================");
      $('form').remove();
      if($('form').length == 0) {
          $('.modal-content').append(form);
      }
      params.berhasil(data);
    })
    .always(function(jqXHR, textStatus, errorThrown){//data|jqXHR, textStatus, jqXHR|errorThrown
      console.log("Complete Local ================================");
      params.selalu(jqXHR, textStatus, errorThrown);
      $("#modal").on('hidden.bs.modal', function(e){
          $('.modal').remove();
      });
    });

    //modal ditutup
    $("#modal").on('hidden.bs.modal', function(e){
        //$('.modal').remove();
        xhr.abort();
    });
  };

  self.Write = function(params){
    xhr = $.ajax({

    });
  }

  //Return Object
  return self;
})($);

$(function(){});