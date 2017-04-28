<a class="dropdown-item" href="{{ route('glitter.office.account.profile') }}"><i class="fa fa-user-circle-o fa-fw" aria-hidden="true"></i> プロフィール</a>
<a class="dropdown-item" href="{{ route('glitter.office.account.security') }}"><i class="fa fa-lock fa-fw" aria-hidden="true"></i> セキュリティ</a>
<div class="dropdown-divider"></div>
<a class="dropdown-item" href="#" @click.prevent="logout"><i class="fa fa-sign-out fa-fw" aria-hidden="true"></i> ログアウト</a>
