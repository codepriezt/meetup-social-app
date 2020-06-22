<template>
    <div class="col-lg-8 col-md-12 pd-right-none pd-left-none">
            <div class="main-conversation-box">
                 <div class="message-bar-head">
                      <div class="usr-msg-details">
                                <div class="usr-ms-img">
                                    <img src="images/resources/m-img1.png" alt="">
                                </div>
                                <div class="usr-mg-info">
                                <h3>{{contact ? contact.name : "Select a contact"}}</h3>
                                <p>Online</p>
                                </div>
                                <!--usr-mg-info end-->
                            </div>
                            <a href="#" title=""><i class="fa fa-ellipsis-v"></i></a>
                        </div>
                        <MessagesFeed :contact="contact"  :messages="messages"/>
                        <MessageComposer @send="sendMessage"/> 
            </div>
    </div>                      
</template>
<script>
 import  MessagesFeed from './MessagesFeed';
 import  MessageComposer from './MessageComposer';

export default {
     props:{
        contact:{
            type:Object,
            default:null,
        },

        messages:{
            type:Array,
        
        }
    },
        methods:{
            sendMessage(text){
                console.log(text)
            }
        },
        components:{MessagesFeed , MessageComposer}
    
}
</script>