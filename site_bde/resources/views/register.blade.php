@extends('template')

@section('title')
    <title>Sign up</title>
@endsection

@section('body')
    <form action="register" method="post">
        @csrf()
        <table>
            <tr>
                <td>First name</td>
                <td><input  type="text" name="first_name"></td>
            </tr>
            <tr>
                <td>Last name</td>
                <td><input  type="text" name="last_name"></td>
            </tr>
            <tr>
                <td>Location</td>
                <td><input  type="text" name="location"></td>
            </tr>
            <tr>
                <td>E-mail Address</td>
                <td><input  type="text" name="email"></td>
            </tr>
            <tr>
                <td>Password</td>
                <td><input  type="password" name="password"></td>
            </tr>
            <tr>
                <td><input  type="submit" value="Sign up"></td>
            </tr>
        </table>
    </form>
@endsection