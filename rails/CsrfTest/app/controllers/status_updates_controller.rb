class StatusUpdatesController < ApplicationController
  def create
    if logged_in?
      @update = StatusUpdate.new(params[:status_update])
      @update.author = session[:user_name]
      @update.save
    else
      logger.warn 'Someone tried to update status without valid login info!'
    end
    redirect_to root_url
  end

  def index
    @messages = StatusUpdate.order('created_at DESC')

    @status_update = StatusUpdate.new
  end
end
