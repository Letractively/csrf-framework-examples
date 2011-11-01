class CreateStatusUpdates < ActiveRecord::Migration
  def change
    create_table :status_updates do |t|
      t.string :author, :null => false
      t.string :status, :null => false

      t.timestamps
    end
  end
end
