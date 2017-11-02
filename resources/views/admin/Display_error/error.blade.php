<?php
/**
 * Created by PhpStorm.
 * User: DELL
 * Date: 6/21/2017
 * Time: 7:43 AM
 */
?>

@if(count($errors)>0)
    <div class="alert alert-danger">
        <ul>
            @foreach($errors->all() as $error)
                <li>{!! $error !!}</li>
            @endforeach
        </ul>
    </div>
@endif