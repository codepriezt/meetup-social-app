<template>
      <div class="message-send-area">
                                <div class="mf-field">
                                    <input type="text" name="message" placeholder="Type a message here" @keydown.enter="send">
                                    <button type="submit" @click="send">Send</button>
                                </div>
                                <ul>
                                    <li><a href="#" title=""><i class="fa fa-smile-o"></i></a></li>
                                    <li><a href="#" title=""><i class="fa fa-camera"></i></a></li>
                                    <li><a href="#" title=""><i class="fa fa-paperclip"></i></a></li>
                                </ul>
                        </div>
                        
</template>
<script>
export default {
        data(){
            return{
                message:''
            }
        },
        methods : {
            send(){
                  if(this.message == ''){
                      return;
                  }
                  this.$emit('send'. this.message);
                      this.message = ''; 
                  
            }
        }
}   
</script>