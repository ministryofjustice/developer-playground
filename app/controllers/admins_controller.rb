# frozen_string_literal: true

class AdminsController < ApplicationController
  before_action :authenticate_user!
  before_action :admin_user_access

  # def index
  # @user = User.includes(:articles, :comments)
  # end

  # def show
  # @user = User.find(params[:id])
  # end

  private

  def admin_user_access
    return if current_user&.role == 'admin'

    redirect_to new_user_session_path, alert: 'Access denied: Admins only.'
  end
end
