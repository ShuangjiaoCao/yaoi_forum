
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
var id =  $('#blockpost').val();

 $('[id^=blockform]').submit(function(event){

        $.ajax({
            type: 'POST',
            url: '/post/' + id + '/block',
            data: $('form#ajax').serialize(),
            dataType: 'json',
        })

        .done(function(data) { 

            if(data['response'] ==0 ){
alert("成功解锁！" + data['response'] );
location.reload();

            } else {
alert("成功锁帖！" + data['response'] );

location.reload();

            }
        });
        //just to be sure its not submiting form
        return false;
    });



var id =  $('#toppost').val();

 $('[id^=topform]').submit(function(event){
        //event.preventDefault();

        $.ajax({
            type: 'POST',
            url: '/post/' + id + '/top',
            data: $('form#ajax').serialize(),
            dataType: 'json',
        })

        .done(function(data) { 

            if(data['response'] ==0 ){
alert("取消置顶！" + data['response'] );
location.reload();

            } else {
alert("成功置顶！" + data['response'] );

location.reload();

            }

        });
        //just to be sure its not submiting form
        return false;
    });



//var collapse = $('[id^=nestedComment]');


  //$('[id^=childCommentButton]').on('click', function(e) {
    $('[id^=childCommentButton]').click(function(){

var commentid=$(this).attr("value");
//var test = $(this).find("div" ).id;
var collapse =$("#nestedComment" + commentid);


   if(collapse.hasClass("in")){
     collapse.toggle();
       //收起  glyphicon glyphicon-arrow-down
      //alert(collapse.attr("class"));
$(this).find('#huifu').text("回复此楼");
//$(this).find('#arrowicon').setAttribute('class', 'glyphicon glyphicon-arrow-down');
     $(this).find('#arrowicon').attr("class","glyphicon glyphicon-arrow-down");
   collapse.removeClass("in");

   } else{
     collapse.toggle();
 //alert("2");
//$('[id^=huifu]').text("收起回复");
$(this).find('#huifu').text("收起回复");
//$(this).find('#arrowicon').setAttribute('class', 'glyphicon glyphicon-arrow-down');
  $(this).find('#arrowicon').attr("class","glyphicon glyphicon-arrow-up");
collapse.addClass("in");

   }




  });
 



//var id = $('[id^=nestcommentSend]').val();
//console.log(id);





//$('#postchildcomment$id').submit(function(event){

 $('[id^=postchildcomment]').submit(function(event){    // this is not the button
  event.preventDefault();

 //var btn = $(this).find("input[type=submit]:focus" );
//var parent_comment_id =  $('[id^=nestcommentSend]').val();
var parent_comment_id = $(this).find("button[type=submit]" ).val();
var comment_content = $("#nestcommentinput" + parent_comment_id).val();
var comment_name = $("#nestcommentName" + parent_comment_id).val();



var dataString = 'comment_content='+comment_content+'&parent_comment_id='+parent_comment_id+'&comment_name='+comment_name;

       
     $querry=   $.ajax({
            type: 'POST',
            url: '/comment/nestComment',
            data: dataString,
            dataType: 'json',
        })

        .done(function(data) {  
         // console.log("saved!!");
          //console.log(data);
var content = data['content'];
var name = data['name'];
var time = data['time'];
//alert(time);
//var jsdate = (new Date()).toISOString();
var lists = document.getElementById("commentList"+parent_comment_id);
var newitem = document.createElement('li');  
newitem.setAttribute("id", "childlist");
newitem.className = "am-g"; 

//anewitem.addClass("am-g");
newitem.innerHTML = "<div class='commentText'>"+content + "</div>" +
           "<div id='child-comment-meta'  style='display:inline'>" +
            "<a href='#link-to-user' class='am-comment-author'>" +name + "</a>" + 
             "评论于" +time +"</time>" 
           +"</div>";





//var child = document.createTextNode(content+ name + time);

//newitem.appendChild(document.createTextNode(content));
lists.appendChild(newitem);
alert("评论成功！");


           }  

           );
      //alert("false");
     //return false



         });






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
        .one('click', '#sure', function() {
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