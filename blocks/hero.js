/**
 * Hero Block
 *
 * Custom Gutenberg block for a hero slider using Swiper.
 */
import { registerBlockType } from '@wordpress/blocks';
import { __ } from '@wordpress/i18n';
import { useBlockProps, MediaUpload, PlainText } from '@wordpress/block-editor';
import { Button } from '@wordpress/components';

registerBlockType('vab/hero', {
  apiVersion: 3,
  title: __('Hero Slider', 'vab'),
  description: __('A hero slider with Swiper, supporting lazy loading, parallax, and crossfade.', 'vab'),
  category: 'layout',
  icon: 'slides',
  attributes: {
    slides: {
      type: 'array',
      default: [],
      source: 'query',
      selector: '.swiper-slide',
      query: {
        image: {
          type: 'object',
          source: 'query',
          selector: 'img',
          query: {
            url: { type: 'string', source: 'attribute', attribute: 'data-src' },
            alt: { type: 'string', source: 'attribute', attribute: 'alt' },
          },
        },
        title: {
          type: 'string',
          source: 'text',
          selector: '.swiper-slide > div:last-child',
        },
      },
    },
  },
  edit: ({ attributes, setAttributes }) => {
    const { slides } = attributes;
    const blockProps = useBlockProps();

    const addSlide = () => {
      setAttributes({
        slides: [...slides, { image: {}, title: 'New Slide' }],
      });
    };

    const updateSlide = (index, key, value) => {
      const newSlides = [...slides];
      newSlides[index][key] = value;
      setAttributes({ slides: newSlides });
    };

    const removeSlide = (index) => {
      const newSlides = slides.filter((_, i) => i !== index);
      setAttributes({ slides: newSlides });
    };

    return (
      <div {...blockProps}>
        <h2>{__('Hero Slider', 'vab')}</h2>
        {slides.map((slide, index) => (
          <div key={index} style={{ border: '1px solid #ccc', padding: '10px', marginBottom: '10px' }}>
            <MediaUpload
              onSelect={(media) => updateSlide(index, 'image', { url: media.url, alt: media.alt })}
              allowedTypes={['image']}
              value={slide.image?.id}
              render={({ open }) => (
                <Button onClick={open} isSecondary>
                  {slide.image?.url ? __('Replace Image', 'vab') : __('Select Image', 'vab')}
                </Button>
              )}
            />
            {slide.image?.url && (
              <img src={slide.image.url} alt={slide.title} style={{ maxWidth: '100px', marginTop: '10px' }} />
            )}
            <PlainText
              value={slide.title}
              onChange={(value) => updateSlide(index, 'title', value)}
              placeholder={__('Slide Title', 'vab')}
              style={{ marginTop: '10px' }}
            />
            <Button isDestructive onClick={() => removeSlide(index)} style={{ marginTop: '10px' }}>
              {__('Remove Slide', 'vab')}
            </Button>
          </div>
        ))}
        <Button isPrimary onClick={addSlide}>
          {__('Add Slide', 'vab')}
        </Button>
      </div>
    );
  },
  save: () => null,
});