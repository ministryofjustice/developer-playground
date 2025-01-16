# frozen_string_literal: true

# == Schema Information
#
# Table name: articles
#
#  id         :integer          not null, primary key
#  title      :string
#  body       :text
#  created_at :datetime         not null
#  updated_at :datetime         not null
#  status     :string
#  user_id    :integer          not null
#  views      :integer          default(0)
#
require 'rails_helper'

RSpec.describe Article, type: :model do
  let(:user) { create(:user) }

  context 'with invalid params' do
    let(:article) { described_class.new(user:, title: 'title 1', body: 'body text and content', status: 'public') }
    let(:errors) { article.errors.messages }

    it 'is invalid without a user' do
      article.user = nil
      expect(article).not_to be_valid
    end

    it 'is invalid without a title' do
      article.title = nil
      expect(article).not_to be_valid
      expect(errors[:title]).to include "can't be blank"
      expect(errors[:title]).to include 'is too short (minimum is 1 character)'
    end

    it 'is invalid without a body' do
      article.body = nil
      expect(article).not_to be_valid
      expect(errors[:body]).to include "can't be blank"
    end

    it 'is invalid when body is less than 10 characters' do
      article.body = 'text'
      expect(article).not_to be_valid
      expect(errors[:body]).to include 'is too short (minimum is 10 characters)'
    end

    it 'is invalid without a status' do
      article.status = nil
      expect(article).not_to be_valid
      expect(errors[:status]).to include 'is not included in the list'
    end
  end

  context 'with valid params' do
    it 'is valid' do
      article = described_class.new(user:, title: 'title 1', body: 'body text and content', status: 'public')
      expect(article).to be_valid
    end
  end
end
