class StatusUpdate < ActiveRecord::Base
  validates_presence_of :author, :status
end
