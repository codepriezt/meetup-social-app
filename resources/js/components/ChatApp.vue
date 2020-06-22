<template>
					<div class="row">
						<div class="col-lg-4 col-md-12 no-pdd">
							<div class="msgs-list">
								<div class="msg-title">
									<h3>Messages</h3>
									<ul>
										<li><a href="#" title=""><i class="fa fa-cog"></i></a></li>
										<li><a href="#" title=""><i class="fa fa-ellipsis-v"></i></a></li>
									</ul>
								</div>
                                <Contactslist :contacts="contacts"  @selected="startConversationWith"/>
							</div>
						</div>
                        <Conversation :contact="selectedContact"  :message="messages"/>
					</div>
</template>
<script>

import Conversation from './Conversation';
import Contactslist from './Contactslist';
export default {

        props:{
            user:{
                type:Object,
                required:true,

            }
        },

        data(){
            return{
                    selectedContact:null,
                    messages:[],
                    contacts:[]
            }    
        },
        mounted(){
                axios.get('/contact')
                .then((response)=>{
                    this.contacts = response.data
                })
        },
        methods:{
            startConversationWith(contact){
                axios.get(`/conversation/${contact.id}`)
                .then((response)=>{
                    this.messages = response.data
                    this.selectedContact = contact
                })
            }
        },
        components:{Conversation , Contactslist}

}
</script>