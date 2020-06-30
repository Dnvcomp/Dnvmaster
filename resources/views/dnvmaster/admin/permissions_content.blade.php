<div class="col-md-12 col-sm-12 col-xs-12">

        <div class="section-heading text-center">
            <h2>Привилегии</h2>
        </div>
        <div class="row">
            <form action="{{ route('admin.permissions.store') }}" method="post" class="primary-form">
                {{ csrf_field() }}
                <table class="table">
                    <thead>
                        <th class="th-articles">
                            <h4>Привилегии</h4>
                        </th>
                        @if(!$roles->isEmpty())
                            @foreach($roles as $role)
                                <th>
                                    <h4>{{ $role->name }}</h4>
                                </th>
                            @endforeach
                        @endif
                    </thead>
                    <tody>
                        @if(!$priv->isEmpty())
                            @foreach($priv as $value)
                                <tr>
                                    <td>{{ $value->name }}</td>
                                    @foreach($roles as $role)
                                        <td>
                                            @if($role->hasPermission($value->name))
                                                <input checked name="" type="checkbox" value="">
                                            @else
                                                <input name="" type="checkbox" value="">
                                            @endif
                                        </td>
                                    @endforeach
                                </tr>
                            @endforeach
                        @endif
                    </tody>
                </table>
                <button type="submit" class="button button-primary mt-30">Обновить</button>
            </form>
        </div>
</div>