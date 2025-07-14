using UnityEngine;
using UnityEngine.UI;

public class PlayerHealth : MonoBehaviour
{
    [Header("Configura��o de Vida")]
    public int maxHearts = 5;
    public int currentHearts;

    [Header("Refer�ncia dos Cora��es")]
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
            TakeDamage(1); // Remove 1 cora��o
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
            hearts[i].enabled = (i < maxHearts); // Desativa cora��es extras
        }
    }

    //void Die()
    //{
    //    Debug.Log("Player morreu!");
    //    // Adicione aqui l�gica de morte (reiniciar cena, tela de game over, etc)
    //}
}
