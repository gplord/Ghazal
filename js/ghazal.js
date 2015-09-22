$(function () {
  $('[data-toggle="tooltip"]').tooltip({container: 'body', placement: 'right', trigger: 'hover'})
});
$.each($('.poem-line'), function() {
  $(this).tooltip({container: 'body', placement: 'left', trigger: 'manual'}).tooltip('show');
});

$(document).ready(function(){

var typingTimer;
var autoFillInterval = 250;
var rhymeMatches = [];

$('.poem-line-free, .poem-line-first, .poem-line-rhyme').keyup(function(){
    clearTimeout(typingTimer);
    if ($(this).val().length) {
      typingTimer = setTimeout(autoFill, autoFillInterval, $(':focus').parent().data("line-no"));
    } else {
      $(this).data("block-syllables",0);      
      updateLineSyllableCount($(this));
    }
});

$('.poem-line').keydown(function(){
    clearTimeout(typingTimer);
    $('.poem-line').css("border","");
});

$('#repeat').keyup(function() {
    clearTimeout(typingTimer);
    if ($(this).val().length) {
      typingTimer = setTimeout(autoFillRepeat, autoFillInterval);
    } else {
      $(this).data("block-syllables",0);      
      updateLineSyllableCount($(this));
    }
});
$('#repeat').keydown(function() {
    clearTimeout(typingTimer);
});

function autoFillRepeat() {  
    autoFill();
    $('.poem-line-repeat').val($('#repeat').val())
    $('.poem-line-repeat').data("block-syllables", $('#repeat').data("block-syllables"));
    $('.poem-line-repeat').tooltip('hide')
        .attr('data-original-title', $('#repeat').data("block-syllables"))
        .tooltip('fixTitle')
        .tooltip('show');
}

$('#rhyme').keyup(function() {
    clearTimeout(typingTimer);
    if ($(this).val().length) {
      typingTimer = setTimeout(autoFillRhyme, autoFillInterval);
    } else {
      $(this).data("block-syllables",0);      
      updateLineSyllableCount($(this));
    }
});
$('#rhyme').keydown(function() {
    clearTimeout(typingTimer);
});

function autoFillRhyme() {  
    
    autoFill();
    var $focused = $('#rhyme');
    $.post( "rhyme-word.php", { word:$focused.val() }, function( data ) {

      rhymeMatches = $.parseJSON( data.toLowerCase() );
      
      if (rhymeMatches && rhymeMatches.words && rhymeMatches.quality && rhymeMatches.quality > 0) {
    
        $( ".poem-line-rhyme" ).autocomplete({
          source: rhymeMatches.words
        });
        
        var sidebarList = $("#sidebar-list");
        sidebarList.empty();
  
          $("#rhyme-placeholder").css("display","none");
          $(".rhyme-title").text('Rhyming Suggestions');
          $(".rhyme-title").append(" for &quot;<strong>" + ($focused.val()) + "</strong>&quot;");
          
          if (rhymeMatches.quality > 1) { // This means "less" quality, where 1 is best 
          
          }
          
        $.each(rhymeMatches.words, function(k,v) {
            sidebarList.append("<li>" + v + "</li>");
        });
        
      } else {
         $("#sidebar-list").empty();
         $("#rhyme-placeholder").html("<p class='alert alert-danger'>No words were found that matched your rhyming word.</p><p>This might mean:</p> <ul><li>the field is empty</li><li>you entered more than one word, or</li><li>you entered a word not found in the dictionary</li><li>you entered a word that was too long or unique to have rhyming matches</li></ul></p><p>(You can still type your rhyming words manually, or try a different word.)</p>");
         $("#rhyme-placeholder").css("display","block");
      }     
      
    });

}

function autoFill (line) {
    
    var $focused = $(':focus');
    var count;
    $.post( "count-line.php", { line: $focused.val().replace(/(['"])/g, "\\$1") }, function( data ) {
      
      count = data;
      $focused.data("block-syllables", count);
      
      if ($focused.is("#repeat")) {
        $('.poem-line-repeat').each(function(k,v) {
          $(this).data("block-syllables",count);
          $(this).tooltip('hide').attr('data-original-title', count)
            .tooltip('fixTitle')
            .tooltip('show');
          updateLineSyllableCount($(this));
        });
      }
      
      $focused.tooltip('hide')
        .attr('data-original-title', count)
        .tooltip('fixTitle')
        .tooltip('show');
      
      updateLineSyllableCount($focused);
      
    });
    
}

function updateLineSyllableCount(element) {
  var $focused = element;
  var lineSyllables = 0;
      $focused.parent().children('input').each(function(k,v) {
        lineSyllables += parseInt($(this).data("block-syllables"));
      });      
      
      $focused.parent().data("line-syllables", lineSyllables);
      $focused.parent().attr('data-original-title',lineSyllables).tooltip('fixTitle').tooltip('show');
}

$('#btn-add-couplet').click(function() {
  
  $('#couplets').append($( "#couplet-template" ).html());
  
  $('#couplets').children().last().attr("id","couplet-" + (parseInt($('#poem').data('num-couplets'))+1));
  $('#couplets').children().last().children().first().attr("id","poem-line-" + (parseInt($('#poem').data("num-lines"))+1));
  $('#couplets').children().last().children().last().attr("id","poem-line-" + (parseInt($('#poem').data("num-lines"))+2));
  
  $('#couplets').children().last().children().first().data("line-no", (parseInt($('#poem').data("num-lines"))+1));
  $('#couplets').children().last().children().last().data("line-no", (parseInt($('#poem').data("num-lines"))+2));
    
  $('#poem').data('num-lines',parseInt($('#poem').data('num-lines'))+2);
  $('#poem').data('num-couplets',parseInt($('#poem').data('num-couplets'))+1);
  
  autoFillRhyme();
  autoFillRepeat();
  
});

$('#btn-generate').click(function() {
  
  var lines = [];
  $('#couplets').children().children('.poem-line').each(function(k,v) {
    lines[k] = "";
    $(this).children('input').each(function(l,w){      
      lines[k] += $(this).val() + " ";
    });
  });
  
  $("#my-ghazal .ghazal-title").html($("#poem-title").val());
  $("#my-ghazal .ghazal-author").html("by " + $("#poem-author").val());
  
  $("#poem-text").empty();
  $(lines).each(function(k,v) {
    if (k % 2) {
      $("#poem-text").children().last().append(v);
    } else {
      $("<p class='my-ghazal-couplet'>").html(v + "<br>").appendTo("#poem-text");
    }
  });

  $("#save").show();
  
});

$( "#save-poem" ).click(function( event ) {
  if (isEmail($("#poem-email").val())) {
     $("#poem-email").parent().removeClass("has-error");
     
     savePoem();
     
  } else {
    $("#poem-email").parent().addClass("has-error");
  }
  event.preventDefault();
});

function isEmail(email) {
  var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
  return regex.test(email);
}

function savePoem() {

  poemData = new Object;
  poemData["poem_title"] = $('#poem-title').val();
  poemData["poem_author"] = $('#poem-author').val();
  poemData["poem_email"] = $('#poem-email').val();
  poemData["poem_text"] = $('#poem-text').html();
    
  $.post( "savepoem.php", { poemdata:poemData }, function( data ) {
      
      if (data == 1) {
        $('#ajax-reply').html("<p class='alert alert-success'>Poem saved!</p>");
        setTimeout(clearSaveReply, 2000);
      } else {        
        $('#ajax-reply').html("<p class='alert alert-danger'>Error saving!  <strong>Please save your poem by hand,</strong> until this is resolved!</p>");
      }
      
    });
  
}

function clearSaveReply() {
  $('#ajax-reply').empty();
}

});