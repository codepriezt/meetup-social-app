<template>
    <div class="messages-list">
        <ul>
            <li :class="{'selected':index == selected}" v-for="(contact , index) in contacts" :key="contact.id"  @click="selectContact(index , contact)">
                <div class="usr-msg-details">
                    <div class="usr-ms-img">
                        <img src="images/resources/m-img1.png" alt="">
                        <span class="msg-status"></span>
                    </div>
                    <div class="usr-mg-info">
                        <h3>{{contact.username}}</h3>
                        <p>Lorem ipsum dolor <img src="images/smley.png" alt=""></p>
                    </div><!--usr-mg-info end-->
                    <span class="posted_time">1:55 PM</span>
                </div><!--usr-msg-details end-->
            </li>
        </ul>
    </div>
</template>
<script>
export default {
    
        props:{
        contacts:{
            type:Array,
            default:[]
        },
    },
        data(){
            return{
                selected:0
            };
        },
        methods:{
            selectContact(index , contact){
                this.selected = index;

                this.$emit('selected' , contact);
            }
        }
    
}
</script>