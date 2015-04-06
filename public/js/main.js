
function activateTab(pageId) {
          var tabCtrl = document.getElementById('tabCtrl');
          var pageToActivate = document.getElementById(pageId);
          for (var i = 0; i < tabCtrl.childNodes.length; i++) {
              var node = tabCtrl.childNodes[i];
              if (node.nodeType == 1) { /* Element */
                  node.style.display = (node == pageToActivate) ? 'block' : 'none';
                 // node.class =  (node == pageToActivate) ? 'active' : 'none';
                 



              }
          }
      }





$(document).ready(function(){



var id =  $('#faverate').val();


 $('[id^=faverate]').submit(function(event){
        event.preventDefault();

        $.ajax({
            type: 'POST',
            url: '/post/' + id + '/faverates',
            data: $('form#ajax').serialize(),
            dataType: 'json',
        })

        .done(function(data) {  

           // console.log(data['response']);
            if (data['response'] == false) {  //already liked the post
               //alert("cancel");        
                  $('#faverate-modal-cancle').modal('show');
               // $('#alert11').show();            
               $('[id^=faverate]').removeClass('am-active');      //cancel the like
            } else {
               //alert("like it"); 
                    $('#faverate-modal').modal('show');
                 // $('#alert11').show(); 
                $('[id^=faverate]').addClass('am-active');
            }


        });
        //just to be sure its not submiting form
        return false;
    });


  $('[id^=delete]').on('click', function(e) {
   var $form=$(this).closest('form'); 
    e.preventDefault();
    $('#confirmDelete').modal({ backdrop: 'static', keyboard: false })
        .one('click', '#delete', function() {
            $form.trigger('submit'); // submit the form
        });


  });
 

   
/*
  $('[id^=delete]').on('click', function() {
      
      //$('.am-modal-bd').text('确定删除吗？');
      $('#my-confirm').modal({
        relatedTarget: this,
        onConfirm: function(options) {
          console.log("hey");
          $(this.relatedTarget).parent().submit();


        },
        onCancel: function() {
        }
      });
    });*/






$('#halloworld li a').click(function (e) {
    //console.log("hhh");
  $('#halloworld li.active').removeClass('active');
  $(this).parent('li').addClass('active');
  //$(this).addClass('active');
 
});

//var root = '{{url("/")}}';
//create the DOM object
    var newSpan = document.createElement('span');
    // add the class to the 'spam'
    newSpan.setAttribute('class', 'caret');
    



$("#circlename_input").autocomplete({

    source: root + '/get_auto_Circle',
    delay: 0, 
    minLength: 1
   

});

$("#circle_search").autocomplete({

    source: root + '/get_auto_Circle',
    delay: 0, 
    minLength: 1
   

});

$("#charakters_search").autocomplete({

    source: root + '/get_auto_Charakters',
    delay: 0, 
    minLength: 1
   

});

$("#tags_search").autocomplete({

    source: root + '/get_auto_Tags',
    delay: 0, 
    minLength: 1
   

});

$("#circle_search").autocomplete({

    source: root + '/get_auto_Circle',
    delay: 0, 
    minLength: 1
   

});

$("#cps_search").autocomplete({

    source: root + '/get_auto_Cps',
    delay: 0, 
    minLength: 1
   

});



$("#cps").tagit({
 autocomplete: {
    source: root + '/get_auto_Cps',
    delay: 0, minLength: 1

  }, 



});





$("#charakters").tagit({
 autocomplete: {
    source: root + '/get_auto_Charakters',
    delay: 0, minLength: 1

  }
});




$("#tags").tagit({
 autocomplete: {
    source: root + '/get_auto_Tags',
    delay: 0, minLength: 1

  }
});
  
 var tagged_cps =  $("#cps").tagit("assignedTags");  
 var tagged_charakters =  $("#charakters").tagit("assignedTags");  
 var tagged_tags =  $("#tags").tagit("assignedTags");    



/* 

$.ajax({
        type: "POST",
        url: "PostController.php",
        data:{cps: tagged_cps}
    }) */

//$tags_re= preg_replace("/(\n)|(\s)|(\t)|(\')|(')|(，)|(\.)/",',',Input::get('tags'));
/*  
$('#charakters' ).selectize({
    delimiter: REGEX_EMAIL,
    persist: true,
    create: function(input) {
        return {
            value: input,
            text: input
        }
    }
});*/




});