class UserSessionsController < ApplicationController
  def create
    # login
    session[:user_name] = params[:user_name]
    redirect_to root_url
  end

  def destroy
    # logout
    reset_session
    redirect_to root_url
  end
end
