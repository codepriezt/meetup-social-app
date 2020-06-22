<template>
     <div class="messages-line" v-if="contact">
                            <!--main-message-box end-->
                            <div class="main-message-box ta-right">
                                <div class="message-dt" v-for="message in messages" :class="`message${message.to == contact.id ? ' sent' : ' received'}`" :key="message.id">
                                    <div class="message-inner-dt">
                                        <p>{{message.text}}</p>
                                    </div>
                                    <!--message-inner-dt end-->
                                    <span>Sat, Aug 23, 1:08 PM</span>
                                </div>
                                <!--message-dt end-->
                                <div class="messg-usr-img">
                                    <img src="images/resources/m-img2.png" alt="">
                                </div>
                                <!--messg-usr-img end-->
                            </div>
                            <!--main-message-box end-->
                            <div class="main-message-box st3">
                                <div class="message-dt st3">
                                    <div class="message-inner-dt">
                                        <p>Cras ultricies ligula.<img src="images/smley.png" alt=""></p>
                                    </div>
                                    <!--message-inner-dt end-->
                                    <span>5 minutes ago</span>
                                </div>
                                <!--message-dt end-->
                                <div class="messg-usr-img">
                                    <img src="images/resources/m-img1.png" alt="">
                                </div>
                                <!--messg-usr-img end-->
                            </div>
                        </div>
</template>