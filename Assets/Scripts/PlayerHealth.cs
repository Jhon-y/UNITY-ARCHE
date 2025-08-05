using UnityEngine;
using UnityEngine.SceneManagement;
using UnityEngine.UI;

public class PlayerHealth : MonoBehaviour
{
    [Header("Player Health")]
    public int maxHealth = 5;
    public int currentHealth;

    [Header("Heart UI")]
    public Image[] hearts;
    public Sprite fullHeart;
    public Sprite emptyHeart;

    [Header("References")]
    public GameObject deathUI;       // "You Died" UI Panel
    public Animator anim;            // Animator reference

    private bool isDead = false;

    void Start()
    {
        currentHealth = maxHealth;

        if (deathUI != null)
            deathUI.SetActive(false);

        UpdateHearts();
    }

    void Update()
    {
        Debug.Log("Update está rodando");

        if (Input.GetKeyDown(KeyCode.K))
        {
            Debug.Log("Tecla K pressionada");
            TakeDamage(1);
        }
    }


    public void TakeDamage(int damage)
    {
        if (isDead) return;

        currentHealth -= damage;
        currentHealth = Mathf.Clamp(currentHealth, 0, maxHealth);

        UpdateHearts();

        if (currentHealth <= 0)
        {
            Die();
        }
    }

    void Die()
    {
        isDead = true;
        Debug.Log("Die() FOI CHAMADO");

        if (anim != null)
        {
            Debug.Log("Animador encontrado");
            anim.SetTrigger("IsDie");
        }
        else
        {
            Debug.LogWarning("Animador NÃO encontrado!");
        }

        // Desativa controles
        var movementScript = GetComponent<PlayerController>();
        if (movementScript != null)
            movementScript.enabled = false;

        Invoke(nameof(ShowDeathPanel), 1.5f);
    }


    void ShowDeathPanel()
    {
        Time.timeScale = 0f;

        if (deathUI != null)
            deathUI.SetActive(true);
    }

    public void Respawn()
    {
        Time.timeScale = 1f;
        SceneManager.LoadScene(SceneManager.GetActiveScene().name);
    }

    public void ReturnToMainMenu()
    {
        Time.timeScale = 1f;
        SceneManager.LoadScene("MainMenu");
    }

    void UpdateHearts()
    {
        if (hearts == null || fullHeart == null || emptyHeart == null) return;

        for (int i = 0; i < hearts.Length; i++)
        {
            if (i < currentHealth)
                hearts[i].sprite = fullHeart;
            else
                hearts[i].sprite = emptyHeart;
        }
    }
}
