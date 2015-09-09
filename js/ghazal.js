$(function () {
  $('[data-toggle="tooltip"]').tooltip({container: 'body', placement: 'right', trigger: 'manual'})
});
$.each($('.poem-line'), function() {
  $(this).tooltip({placement: 'right',trigger: 'manual'}).tooltip('show');
});

$(document).ready(function(){

//setup before functions
var typingTimer;                //timer identifier
var autoFillInterval = 250;  //time in ms, 5 second for example
var rhymeMatches = [];

//on keyup, start the countdown
$('.poem-line, .poem-line-first').keyup(function(){
    clearTimeout(typingTimer);
    typingTimer = setTimeout(autoFill, autoFillInterval, $(':focus').data("line-no"));
});

//on keydown, clear the countdown 
$('.poem-line').keydown(function(){
    clearTimeout(typingTimer);
    $('.poem-line').css("border","");
});

$('#repeat').keyup(function() {
    clearTimeout(typingTimer);
    typingTimer = setTimeout(autoFillRepeat, autoFillInterval);
});
$('#repeat').keydown(function() {
    clearTimeout(typingTimer);
    //$('.poem-line-rhyme').html($('.repeat').val());
});

function autoFillRepeat() {  
    //alert($('#repeat').val());
    $('.poem-line-repeat').val($('#repeat').val());
}

$('#rhyme').keyup(function() {
    clearTimeout(typingTimer);
    typingTimer = setTimeout(autoFillRhyme, autoFillInterval);
});
$('#rhyme').keydown(function() {
    clearTimeout(typingTimer);
    //$('.poem-line-rhyme').html($('.rhyme').val());
});

function autoFillRhyme() {  
    
    var $focused = $(':focus');
    $.post( "rhyme-word.php", { word:$focused.val() }, function( data ) {
      $( "#testajax" ).html( data );
      //console.log(data);
      rhymeMatches = $.parseJSON( data.toLowerCase() );
      //console.log(rhymeMatches[1]);
      
      $( ".poem-line-rhyme" ).autocomplete({
        source: rhymeMatches
      });
      
      //$("#sidebar").html (rhymeMatches);
      var sidebarList = $("#sidebar-list");
      sidebarList.empty();
      $.each(rhymeMatches, function(k,v) {
          sidebarList.append("<li>" + v + "</li>");
      });
      
    });

}

function autoFill (line) {
        
    //var poemPart1 = $('.poem-line').val().split(' ');
    
    var element = $('*[data-line-no="'+line+'"]');
    var poem = element.val();
    console.log(poem);
    
    if (element.next().hasClass("poem-line-rhyme")) {
      
      poem += " "+element.next().val();
    }
    
    $.post( "count-line.php", { line:poem }, function( data ) {
      console.log(data);      
    });
    
    /*
    var $focused = $(':focus');
    //$('#testajax').load('syllables-line.php', { line: $focused.val() }, function() {
    $('#testajax').load('count-line.php', { line: $focused.val() }, function() {
          //$focused.next().children('.tooltip-inner').html($('#testajax').text());
          //$('#testajax').html($('#'))
    });
    */
    
    var $focused = $(':focus');
    $.post( "count-line.php", { line:$focused.val() }, function( data ) {
      $( "#testajax" ).html( data );
    });
    
    $.each($('.poem-line'), function(k, v) {
      
      //$(this).load("syllables-line.php", { line: $(".poem-line").val()});
      
      var thisthis = $(this);
      
      //function(data) {
//        console.log($(data).find('#return').text());
        //$(this).attr('title', $(data).find('#return').text());
//        $(this).next().children('.tooltip-inner').text($(data).find('#return').text());
  //    });
  
      /*
      //console.log($(this));
      if (($(this).data("line-no") % 2) == 0) {
        //$(this).val($(this).val() + " " + last_word);
        //$(this).next('.line-last-word').css("border","10px solid purple");
        $(this).val(last_word);
        console.log($(this));
      }*/
      
    });
    
}

$('#btn-add-couplet').click(function() {
  
  $('#poem').append($( "#couplet-template" ).html());
  
  $('#poem').children().last().attr("id","couplet-" + (parseInt($('#poem').data('num-couplets'))+1));
  $('#poem').children().last().children().first().attr("id","poem-line-" + (parseInt($('#poem').data("num-lines"))+1));
  $('#poem').children().last().children().last().attr("id","poem-line-" + (parseInt($('#poem').data("num-lines"))+2));
  
  $('#poem').children().last().children().first().data("line-no", (parseInt($('#poem').data("num-lines"))+1));
  $('#poem').children().last().children().last().data("line-no", (parseInt($('#poem').data("num-lines"))+2));
    
  $('#poem').data('num-lines',parseInt($('#poem').data('num-lines'))+2);
  $('#poem').data('num-couplets',parseInt($('#poem').data('num-couplets'))+1);
  
});
    
});