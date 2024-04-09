<div class="container">

   
    <p>Hi Admin, your request for interview is {{ ($status == 1) ? 'Approved' : 'Rejected' }}</p>

    <p><strong>User Name: </strong>{!! $username !!}</p>
    <p><strong>User Email: </strong>{!! $user_email !!}</p>
    <p><strong>Subject: </strong>{!! $sub !!}</p>

   

</div>
