<template>
    <div>
        <div class="post_dtls_cmnt_sec mar_t20">
            <h2 class="post_dtls_title2 pad_b20">Comments</h2>

            <!-- comment -->
            <div class="cmnt_box_all">
                <div class="cmnt_box_top dis_flx">
                    <div class="cmnt_box_top_left d-flex">
                        <div class="cmnt_img mar_r15">
                            <img src="img/girl4-cmnt.jpg" alt="image">
                        </div>
                        <div class="cmnnt_name">
                            <div class="cmnt_name_left">
                                <h4 class="tchr_nam mar_b10">Olly Stone</h4>
                            </div>
                            <div class="cmnt_name_right">
                                <p class="cmnt_name_right_p">11 Nov 2019 AT 09:12 AM</p>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="cmnnt_p pad_t10">
                    <p>
                        It was a decent match, I hate to say this because it was already very long but honestly it probably should have been 1 - 3 hours longer to include more explanations of SQL/MySQL, Python and Tableau.
                    </p>
                    <p class="post_reply mar_t5">Reply</p>
                </div>
            </div>
            <!-- comment -->

            <!-- iteam -->
            <div class="cmnt_box_all reply_sec">
                <div class="cmnt_box_top dis_flx">
                    <div class="cmnt_box_top_left d-flex">
                        <div class="cmnt_img mar_r15">
                            <img src="img/girl2-cmnt.jpg" alt="image">
                        </div>
                        <div class="cmnnt_name">
                            <div class="cmnt_name_left">
                                <h4 class="tchr_nam mar_b10">Jofra Archer</h4>
                            </div>
                            <div class="cmnt_name_right">
                                <p class="cmnt_name_right_p">11 Dec 2019 AT 07:45 AM</p>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="cmnnt_p pad_t10">
                    <p>
                        I am on 50% of the course. So far I am very happy about the course. very succinct, practical and straight to the point. I am looking forward to complete this course so I can move onto data science
                    </p>
                    <p class="post_reply mar_t5">Reply</p>
                </div>
            </div>
            <!-- iteam -->
        </div>
    </div>
</template>

<script>
export default {
    data(){
        return  {
            comment: [],
        }
    },
    async created() {
        const res = await this.callApi('get', 'app/get_tags')
        if(res.status == 200) {
            this.comment = res.data
        } else {
            console.log('Error')
        }
    }
}
</script>

<style>

</style>
