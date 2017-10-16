<?php
/**
 * Created by PhpStorm.
 * User: blacksato
 * Date: 31/5/2017
 * Time: 17:44
 */
Route::get('forum','Forum\ForumController@index')->name('forum.index');
Route::get('forum-comment/{forumComment}/delete','Forum\ForumController@deleteComment')->name('forum.delete');
Route::post('forum-comment/save','Forum\ForumController@saveComment')->name('forum.save');
Route::get('forum-comment/{forumComment}/view','Forum\ForumController@viewComment')->name('forum.view');
Route::get('forum-comment/{forumComment}/view-detail','Forum\ForumController@viewCommentDetail')->name('forum.view.detail');
Route::get('forum-comment/{forumComment}/detail-datatable','Forum\ForumController@viewCommentDetailDatatable')->name('forum.view.detail');

Route::get('forum-comment/{forumCommentDetail}/detail-get','Forum\ForumController@getCommentDetail')->name('forum.detail.get');
Route::post('forum-comment/update-detail','Forum\ForumController@updateCommentDetail')->name('forum.update.detail');

Route::post('forum-comment/update','Forum\ForumController@updateComment')->name('forum.update');
Route::post('forum-comment/response','Forum\ForumController@responseComment')->name('forum.response');
Route::post('forum-comment/action','Forum\ForumController@actionComment')->name('forum.comment.action');
Route::get('forum-comment/categoria/{slug}','Forum\ForumController@commentCategory')->name('forum.comment.category');
Route::get('forum-comment/owner/{owner}','Forum\ForumController@commentOwner')->name('forum.comment.owner');
Route::get('forum-comment/owner/categoria/{slug}','Forum\ForumController@commentOwnerCategory')->name('forum.comment.owner.category');

Route::get('forum-comment/{forumCommentDetail}/delete-detail','Forum\ForumController@deleteCommentDetail')->name('forum.delete.detail');