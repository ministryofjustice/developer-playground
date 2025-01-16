# frozen_string_literal: true

require 'rails_helper'

RSpec.describe Visible do
  let(:article) { create(:article) }

  describe '#archived?' do
    context 'when article status is archived' do
      it 'returns true' do
        article.status = 'archived'
        expect(article.archived?).to be true
      end
    end

    context 'when article status is not archived' do
      it 'returns false' do
        article.status = 'public'
        expect(article.archived?).to be false
      end
    end

    describe '#public_count' do
      before do
        create(:article)
      end

      it 'returns to article count' do
        expect(Article.public_count).to eq 1
      end
    end
  end
end
