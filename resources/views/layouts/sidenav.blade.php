<?php 
use Illuminate\Support\Facades\Auth;
?>
<link rel="stylesheet" href="/css/sidenav.css">

<div class="sidenav">
    <div class="logo">
        <div class="image"> 
            <img src="/images/logo.webp" />
        </div>
        <h4 class="pt-3"> Caisse </h4>
    </div>
    <hr style="border : 1px solid #ddd"/>
    <div>
        <ul>
            <li>
                <a href="/dashboard"> 
                    <i class="bi bi-speedometer"></i>
                    <span> Dashboard </span>
                </a>
            </li>
            <li>
                <a href="/list-operation">
                    <i class="bi bi-gear mr-4"></i>
                    <span> Types d'opérations </span>
                </a>
            </li>
        </ul>
    </div>

    <div class="user_connected">
        <span> {{Auth::user()->name }} | </span>
        <a href="/logout"> Deconnexion </a>
    </div>
</div>  