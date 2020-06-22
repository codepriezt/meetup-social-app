<template>
  <li>
                             <a href="#" title="" class="not-box-open" id="markAsRead">
                                <span><img src="" alt=""></span>
                                Notification<span class="badge">{{unreads.length}}</span>
                            </a>

                            <div class="notification-box">
                                <div class="nt-title">
                                    <h4>Setting</h4>
                                    <a href="#" title="">Clear all</a>
                                </div>
                                <div class="nott-list">
                                    
                                </div>
                               
                            </div>
        </li>                
</template>

<script>
    export default {
        props:['unreads' , 'userId'],
        mounted() {
            console.log('Component mounted.');
            Echo.private('App.User.'+ this.userid)
            .notification((notification)=>{
                console.log(notificatiion);
            });
        }
    }
</script>
