<div>
<style>
    nav svg {
        height: 20px;
    }
</style>
    <section>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3>All Usar</h3>
                        </div>
                        <div class="card-body">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                    </tr>
                               </thead>
                               <tbody>
                               @foreach($userss as $usar)
                                    <tr>
                                        <td>{{$usar->id}}</td>
                                        <td>{{$usar->name}}</td>
                                        <td>{{$usar->email}}</td>
                                    </tr>
                                @endforeach    
                               </tbody>
                            </table>
                            {{$userss->links()}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
