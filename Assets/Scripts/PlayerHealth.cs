using UnityEngine;
using UnityEngine.UI;

public class PlayerHealth : MonoBehaviour
{
    [Header("Configuração de Vida")]
    public int maxHearts = 5;
    public int currentHearts;

    [Header("Referência dos Corações")]
    public Image[] hearts;
    public Sprite fullHeart;
    public Sprite emptyHeart;

    void Start()
    {
        currentHearts = maxHearts;
        UpdateHeartsUI();
    }

    void Update()
    {
        // Teste de dano com a tecla H
        if (Input.GetKeyDown(KeyCode.H))
        {
            TakeDamage(1); // Remove 1 coração
        }
    }

    public void TakeDamage(int damageAmount)
    {
        currentHearts = Mathf.Clamp(currentHearts - damageAmount, 0, maxHearts);
        UpdateHeartsUI();

        //if (currentHearts <= 0)
        //{
        //    Die();
        //}
    }

    void UpdateHeartsUI()
    {
        for (int i = 0; i < hearts.Length; i++)
        {
            hearts[i].sprite = (i < currentHearts) ? fullHeart : emptyHeart;
            hearts[i].enabled = (i < maxHearts); // Desativa corações extras
        }
    }

    //void Die()
    //{
    //    Debug.Log("Player morreu!");
    //    // Adicione aqui lógica de morte (reiniciar cena, tela de game over, etc)
    //}
}
