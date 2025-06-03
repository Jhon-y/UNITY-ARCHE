using System.Collections;
using UnityEngine;

public class TransparentObject : MonoBehaviour
{
    [Range(0, 1)]
    [SerializeField] private float _tranparencyValue = 0.7f;
    private float _transparencyFadeTime = .4f;

    private SpriteRenderer _spriteRender;

    void Awake()
    {
        _spriteRender = GetComponent<SpriteRenderer>();
    }

    private void OnTriggerEnter2D(Collider2D collision)
    {
        if (collision.gameObject.GetComponent<PlayerController>())
        {
            StartCoroutine(FadeTree(_spriteRender, _transparencyFadeTime, _spriteRender.color.a, _tranparencyValue));
        }
    }

    private void OnTriggerExit2D(Collider2D collision)
    {
        if (collision.gameObject.GetComponent<PlayerController>())
        {
            StartCoroutine(FadeTree(_spriteRender, _transparencyFadeTime, _spriteRender.color.a, 1f));
        }
    }

    private IEnumerator FadeTree(SpriteRenderer _spriteTranparency, float _fadeTime, float _startValue, float _targetTransparency)
    {
        float _timeElapsed = 0;
        while (_timeElapsed < _fadeTime)
        {
            _timeElapsed += Time.deltaTime;
            float _newAlpha = Mathf.Lerp(_startValue, _targetTransparency, _timeElapsed / _fadeTime);
            _spriteTranparency.color = new Color(
                _spriteTranparency.color.r,
                _spriteTranparency.color.g,
                _spriteTranparency.color.b,
                _newAlpha
            );
            yield return null;
        }
    }
}
