var tag={list : []}
 //############## AJAX call for autocomplete ###########//
              $(".tag_in").keyup(function(evt){
                  if (evt.key=="," || evt.key=="Enter") {
                      // Input check
                      var tagged = evt.key=="," ? this.value.slice(0, -1) : this.value,
                          error = "";

                      // Freaking joker empty input
                      if (tagged=="") {
                        error = "Please enter a valid tag";
                      }

                      // Check if already in tags list
                      if (error=="") {
                        if (tag.list.indexOf(tagged) != -1) {
                          error = tagged + " is already defined";
                        }
                      }

                      // OK - Create new tag
                      if (error=="") {
                        var newTag = document.createElement("span");
                        newTag.classList.add("tag");
                        newTag.innerHTML = tagged;
                        newTag.addEventListener("click", tag.remove);
                        $(".tag_list").append(newTag);
                        tag.list.push(tagged);
                        this.value = "";
                      }

                      // Not OK - Show error message
                      else {
                        this.value = tagged;
                        alert(error);
                      }
                    }
                $.ajax({
                type: "POST",
                url: base_url+"pkdb/readcategory",
                data:'keyword='+$(this).val(),
                
                success: function(data){
                  console.log(data);
                  $(".suggesstion-box").show();
                  $(".suggesstion-box").html(data);
                  $(".search-box").css("background","#FFF");
                }
                });
              });
          //############## AJAX call for autocomplete ###########//
          $(document).on( 'click','.tag',function() {
            tag.list.splice(tag.list.indexOf(this.innerHTML), 1);
            $(this).remove();
            console.log(tag.list);
          });



    function select_tag(val) {
      $(".tag_in").val(val);
      $(".suggesstion-box").hide();
    }
