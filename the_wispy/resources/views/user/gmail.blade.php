@extends('layouts.dashboard')
@section('pageTitle', 'Dashboard for Remote Mobile Monitoring') 
@section('content')
<!-- <link href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet"> -->
<!--  <link href="https://cdn.datatables.net/scroller/2.0.2/css/scroller.dataTables.min.css" rel="stylesheet"> -->
 <link href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet">
 <link href="https://cdn.datatables.net/rowgroup/1.1.2/css/rowGroup.dataTables.min.css" rel="stylesheet">

<div class="row bg-title">
  <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
    <h4 class="page-title dashboard">Gmail</h4> 
  </div>
    <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12 new_syn_btn">
    @include('user.last_sync')
    </div>
  </div>
  <!-- /.col-lg-12 -->
  <div class="row">
    <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
  @if(session()->get('success'))
    <div class="alert alert-success" role="alert">
        {{ session()->get('success') }}
    </div>

    @endif
<div class="white-box for-all" style="border-radius: 20px;" id="vueApp">
<div class="modal fade" id="emailModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" style="border-radius: 20px;">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h2 class="modal-title" id="exampleModalLabel">View Mail</h2>
      </div>
      <div class="modal-body" v-if="result">
            <div class="row">
                <div class="col-md-12" style="margin-bottom: 30px;">
                <div class="col-md-3 text-center"><strong>Sender</strong></div>
                <div class="col-md-9"><strong>@{{ result.sender }}</strong></div>
                </div>
                <div class="col-md-12" style="margin-bottom: 30px;">
                <div class="col-md-3 text-center"><strong>Subject</strong></div>
                <div class="col-md-9">@{{ result.subject }}</div>
                </div>
                <div class="col-md-12" style="margin-bottom: 30px;">
                <div class="col-md-3 text-center"><strong>Message</strong></div>
                <div class="col-md-9">@{{ result.message }}</div>
                </div>
            </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" @click="offModel">Close</button>

      </div>
    </div>
  </div>
</div>


    <div class="no-padding">
        <form @submit.prevent="getSearchData" v-show="myFilter">
            <div class="row">
               <div class="col-md-3 form-group">
               <strong>Name</strong> <input type="text" name="name" class="form-control" placeholder="Name..." v-model="searchName">
                </div>
                <div class="col-md-3 form-group">
               <strong>Subject</strong> <input type="text" name="subject" class="form-control" placeholder="Subject..." v-model="searchSubject">
                </div>
                <div class="col-md-3 form-group">
                   <strong>From</strong><input type="datetime-local" name="fromdate" class="form-control" v-model="searchFrom">
                </div> 
                <div class="col-md-3 form-group">
                <strong>To</strong><input type="datetime-local" name="todate" class="form-control" v-model="searchTo">
                </div>
                <div class="col-md-12 text-center form-group">
                    <button type="submit">Search..</button>
                    
                </div>   
            </div>
        </form>
          <table id="example" class="uk-table uk-table-striped sms-table" style="width:100%">
            <thead class="call-log-heading">
              <tr>
                <th>Actions</th>
                <th>Mail</th>
                <th>Date</th>
              </tr>
            </thead>
            <tbody>
                <tr v-for="email in emails" :key="email.id" v-if="emails.length > 0">
                    <td><button class="btn btn-danger btn-sm" @click="removeMail(email.id)"><i class="fa fa-trash" style="color:#fff"></i></button><br>
                    <button class="btn btn-primary btn-sm" @click="watchMail(email.id)"><i class="fa fa-eye" style="color:#fff"></i></button>
                </td>
                    <td @click="watchMail(email.id)"><strong>@{{ email.sender }}</strong><br>@{{ email.subject }}<br>@{{ email.message.substring(0,150) + '...' }}</td>
                    <td><br><br>@{{ new Date(email.date_time).toLocaleString('default', { month: 'long' }) }}, @{{ new Date(email.date_time).getDate() }}, @{{ new Date(email.date_time).getFullYear() }}</td>
                </tr>
                <tr v-else><td class="text-center" colspan="3">
                    Mails Not Found...
                </td></tr>
            </tbody>
            <tfoot v-if="pages > 1">
                <td class="text-center" colspan="4">
                   <button v-for="page in pages" :key="page" @click="handleMails(page)">@{{ page }}</button>
                </td>
            </tfoot>

          </table>
         
            <div class="text-center" v-show="myFilter"><button @click="handleMails">All Mails</button></div>
            <div class="text-center" v-show="!myFilter"><button @click="showFilter">Filter Mails</button></div>
           <!-- @include('user.no_data_found') -->

        </div>
      </div>

      </div>
    </div>
  </div>
  <style type="text/css">
.item {
    width: 40%;
    min-width: 280px;
    padding-top: 10px;
    clear: both;
    position: relative;
    z-index: 1;
}
.item .info {
    background: #f0f0f0;
    border-radius: 5px;
    padding: 10px;
    position: relative;
    margin-left: 10px;
    word-break: normal;
    overflow-wrap: break-word;
    word-wrap: break-word;
}
.item_r {
    float: left;
    clear: both;
}
 .item_r .info {
    margin-left: 0;
    margin-right: 10px;
    background: #4491ff;
    color: #fff;
}
.item .info:before {
    content: "";
    display: block;
    width: 0;
    height: 0;
    position: absolute;
    top: 0;
    left: -10px;
    border-right: 15px solid rgb(201, 243, 201);
    border-bottom: 12px solid transparent;
}
 .item_r .info:before {
    left: auto;
    right: -10px;
    border-right: 0;
    border-left: 15px solid #4491ff;
}
.dataTables_wrapper.no-footer .dataTables_scrollBody {
    border-bottom: 0 solid #111 !important;
}
.dataTables_empty{
      padding-top: 18px !important;
}
.sorting{
  display: none !important;
}
  </style>
  </style>
@endsection

@section('scripts')

<script src="https://unpkg.com/vue@next"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.1/axios.min.js" integrity="sha512-bZS47S7sPOxkjU/4Bt0zrhEtWx0y0CRkhEp8IckzK+ltifIIE9EMIMTuT/mEzoIMewUINruDBIR/jJnbguonqQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script>
     const vueApp = Vue.createApp({

      data(){
        return{
            error: false,
            emails: [],
            isShow: false,
            pages: 0,
            result:null,
            searchName: null,
            searchSubject:null,
            searchFrom: null,
            searchTo: null,
            myFilter: false
        }
      },
      computed:{
         
    

      },


      mounted(){
          this.handleMails();
      },


      methods:{

            async handleMails(page=null){
                if(this.myFilter === true){
                    this.myFilter = false;
                    this.searchName = null;
                    this.searchSubject = null;
                    this.searchFrom = null;
                    this.searchTo = null;
                }
              this.isShow = true;
              if(this.email == ''){
                  this.error = true;

              }else{
                let url = '';
                if(!page){
                   url = `{{ url('gmail-email-default/'.$id) }}`;
                }else{
                    url = `{{ url('gmail-email-default/'.$id) }}?page=${page}`;
                }  
                
                this.error = false;
                const res =  await axios.get(url);
                const response = res.data;
                // console.log(response)
                if(response){
                 
                  this.emails = response.mails;
                  this.pages = response.pages;
                  console.log(response)
                  
                }
                
              }
          },

         async watchMail(id){
                
              
                let searchUrl = `{{ url('gmail-email-find') }}/${id}`;
                const resMail =  await axios.get(searchUrl);
                const responseMain = resMail.data;
                
                if(responseMain){
                 
                  this.result = responseMain;
                  console.log(responseMain)

                    $('#emailModal').modal('show');
                  
                }
          },

          async removeMail(id){
                
                let url = `{{ url('remove-gmail') }}/${id}`;
                const res =  await axios.delete(url);
                if(res.data == 'delete'){
                    this.handleMails();
                }
          },

          offModel(){
            $('#emailModal').modal('hide');
            this.result = null;
          },

          showFilter(){
            this.myFilter = true;
          },


        async getSearchData(){
                let url = `{{ url('search-gmail/'.$id) }}`;
                const res =  await axios.post(url,{
                    name: this.searchName,
                    subject: this.searchSubject,
                    from: this.searchFrom,
                    to: this.searchTo
                });
                // console.log(res.data);
                const response = res.data;
                // console.log(response)
                if(response){
                 
                  this.emails = response.mails;
                  this.pages = response.pages;
                  console.log(response)
                  
                }
          },
          


      }

  }).mount('#vueApp');

</script>


@endsection