<div class="list-group text-center">
    <a href="{{ route('users.edit', $user->id) }}" class="list-group-item {{ active_class(if_route('users.edit')) }}"><i class="glyphicon glyphicon-info-sign"></i>  个人信息</a>
    <a href="{{ route('users.avatar.edit', $user->id) }}" class="list-group-item {{ active_class(if_route('users.avatar.edit')) }}"><i class="glyphicon glyphicon-picture"></i>  修改头像</a>
    <a href="{{ route('users.password.edit', $user->id) }}" class="list-group-item {{ active_class(if_route('users.password.edit')) }}"><i class="glyphicon glyphicon-lock"></i>  修改密码</a>
</div>