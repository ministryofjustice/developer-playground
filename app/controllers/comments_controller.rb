# frozen_string_literal: true

class CommentsController < ApplicationController
  # Ensure a user is logged in before having access
  # unless, its the article index and show views
  before_action :authenticate_user!
  before_action :set_post, on: %i[create destroy]

  def edit
    @comment = @article.comments.find(params[:id])
  end

  def create
    @comment = @article.comments.build(comment_params)
    @comment.user = current_user
    @comment.save
    redirect_to article_path(@article), notice: 'Comment added successfully'
  end

  def destroy
    @comment = @article.comments.find(params[:id])
    @comment.destroy
    redirect_to article_path(@article), status: :see_other, notice: 'Comment deleted successfully'
  end

  # All private methods ensure only the class they're initialized in can access the method
  private

  # Find the article which this comment was assigned to
  # :article_id exists in comments db schema
  def set_post
    @article = Article.find(params[:article_id])
  end

  # params hash ensures the given parameter (e.g :comment) is given
  # then allows which attributes can be permitted for updating
  def comment_params
    params.require(:comment).permit(:body, :status)
  end
end
